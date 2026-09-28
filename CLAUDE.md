# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Website + admin CMS for St. Aloysius school. Laravel 12 (PHP 8.2), Livewire 3 (+ Volt for Breeze auth pages), Spatie Laravel Permission, Tailwind/Vite. Developed locally under WAMP on Windows (`c:\wamp64\www\StAloysius`).

## Commands

```bash
composer dev                 # serve + queue:listen + pail logs + vite, concurrently
npm run dev / npm run build  # Vite; commit public/build after building (see Deployment)
composer test                # config:clear then php artisan test (Pest)
php artisan test --filter=AuthenticationTest          # single test file/class
php artisan test tests/Feature/Auth/AuthenticationTest.php
./vendor/bin/pint            # code style (Laravel Pint)
php artisan migrate:fresh --seed                      # RoleSeeder, SuperAdminSeeder, SettingsSeeder
php artisan permission:cache-reset                    # after any role/permission change
```

Tests run against in-memory SQLite (`phpunit.xml`); only the Breeze auth/profile tests exist.

Custom maintenance commands live in [app/Console/Commands/](app/Console/Commands/) — notably `deploy:setup`, `fix:settings-permission`, `deploy:storage-link`, `user:assign-role {email} {role}`, and a sitemap generator.

## Architecture

**Everything is a full-page Livewire component.** [routes/web.php](routes/web.php) maps URLs directly to component classes; there are almost no controllers (only contact/volunteer form POSTs, CKEditor image upload, sitemap).
- Public site: `App\Livewire\Frontend\*` → views in `resources/views/livewire/frontend/`, rendered with `->layout('components.layouts.app')`.
- Admin: `App\Livewire\Dashboard\<Module>\*` under `/dashboard`, route names prefixed `dashboard.`, layout `components.layouts.dashboard` (a jQuery admin theme loaded from `public/adminassets`, not Vite). Modules typically have an `Index` list component plus a `Manage`/`Form`/`Create` component reused for both create and `{id}/edit` routes via `mount($id = null)`.

**Permissions (Spatie).** Strings are `"<action> <module>"` (e.g. `view blog`, `edit static_pages`); roles are `super admin`, `admin`, `editor`, `user` defined in `database/seeders/RoleSeeder.php`. Enforcement layers:
- Route groups use the `module.permission:<perm>` middleware alias (registered in [bootstrap/app.php](bootstrap/app.php)).
- Blade `@canView('blog')`, `@canCreate`, `@canEdit`, `@canDelete`, `@permission('...')`, `@hasRole` etc. from [app/Providers/PermissionServiceProvider.php](app/Providers/PermissionServiceProvider.php).
- `App\Traits\HasModulePermissions` for component-level checks.
Adding a new admin module means: add permissions to `RoleSeeder`, a route group with the middleware, and a nav entry in `resources/views/livewire/dashboard/partials/header.blade.php`. A missing permission row throws "There is no permission named ... for guard web" — reseed and reset the permission cache (see [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md), [PERMISSIONS.md](PERMISSIONS.md)).

**Content sources.**
- `StaticPage` rows looked up by `page_name` string (e.g. `'Homepage About Us Section'`) drive much of the frontend copy; renaming a page in the DB breaks the page that queries it.
- `Setting` key/value rows (grouped: socials, contact, donation, menu_images, footer, …) accessed via global helpers `setting($key, $default)` / `setting_group($group)`. See [SETTINGS_USAGE.md](SETTINGS_USAGE.md). Settings are uncached DB queries.
- Global helpers in [app/helpers.php](app/helpers.php) (loaded via `require_once` in `AppServiceProvider::boot`, not composer autoload): `formattedDate`, `formattedTime`, `setting*`, `seo_*` (wrapping `App\Helpers\SeoHelper`).
- Admin mutations log to the activity feed via `App\Services\ActivityService::created/updated/deleted(...)`; follow this in new admin components.
- Uploads go to the `public` disk (`storage/app/public`), displayed with `asset('storage/'.$path)`. Many content models store rich text in `content` plus `paragraph1..N` columns populated from CKEditor HTML.

**Public path / hosting quirks.**
- Laravel's public dir is the standard `public/` (`index.php`, `.htaccess`, static `assets/`, `adminassets/`). Vite builds to `public/build`, which is committed (not gitignored) because the FTP deploy doesn't run `npm run build`. The repo's `public_html/build` is a stale leftover. Don't rebind `path.public` via `$this->app->bind()`: Laravel 12 ignores it; use `usePublicPath()` if it ever needs changing.
- Production serves from a `public_html` web root with the app in a sibling `staloysius/` folder. A catch-all `/storage/{path}` route in `web.php` serves files from `storage/app/public` when the symlink is missing; `deploy:storage-link` + `PUBLIC_WEB_ROOT` env creates it.
- `Schema::defaultStringLength(191)` (MySQL on the host); HTTPS forced when `APP_ENV=production`.

## Deployment

[.github/workflows/main.yml](.github/workflows/main.yml) FTP-syncs the repo to the server on **every push to any branch** (excluding `vendor/`, `node_modules/`, `storage/`, `.env`). Pushing is effectively deploying — built assets in `public/build` must be committed, and migrations/seeders must be run on the server manually.
