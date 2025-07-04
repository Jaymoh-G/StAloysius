# Role-Based Permission System Documentation

## Overview

The St. Aloysius School Management System uses a **role-based permission system** based on the Spatie Permission package. This system follows a clean hierarchy where:

1. **Roles** have permissions assigned to them
2. **Users** are assigned roles (not individual permissions)
3. **Users inherit permissions** through their assigned roles

This approach is much cleaner and more maintainable than assigning individual permissions to users.

## Role Hierarchy

The system includes the following predefined roles:

1. **Super Admin** - Full access to all modules and permissions (including role and permission management)
2. **Admin** - Full access to all content modules and user management (cannot manage roles/permissions)
3. **Editor** - Content management permissions (create, edit, publish content)
4. **User** - Basic viewing permissions for public content

## Permission Structure

Each module has the following permission types:

-   `view [module]` - Can view the module
-   `create [module]` - Can create new items
-   `edit [module]` - Can edit existing items
-   `delete [module]` - Can delete items
-   `publish [module]` - Can publish content (for blog, events, careers)
-   `approve [module]` - Can approve content (for testimonials, admissions)
-   `upload [module]` - Can upload files (for gallery)

## Available Modules

-   `dashboard` - Dashboard access
-   `users` - User management
-   `roles` - Role management
-   `permissions` - Permission management
-   `blog` - Blog posts
-   `categories` - Categories
-   `events` - Events
-   `departments` - Departments
-   `facilities` - Facilities
-   `testimonials` - Testimonials
-   `gallery` - Gallery/Albums
-   `careers` - Career opportunities
-   `static_pages` - Static pages
-   `team` - Team members
-   `youtube` - YouTube videos
-   `admissions` - Admissions
-   `academics` - Academic content
-   `reports` - Reports
-   `settings` - System settings

## Role Permissions Summary

### Super Admin

-   **All permissions** across all modules
-   Can manage roles and permissions
-   Full system access
-   **Permissions inherited:** All system permissions

### Admin

-   **User management** (view, create, edit, delete users)
-   **All content modules** (full CRUD operations)
-   **Reports and settings** access
-   Cannot manage roles or permissions
-   **Permissions inherited:** All permissions except role/permission management

### Editor

-   **Content creation and editing** across all modules
-   **Publishing and approval** permissions
-   **Report generation** access
-   Cannot manage users, roles, or permissions
-   **Permissions inherited:** Content management permissions only

### User

-   **View-only access** to public content
-   **Dashboard access**
-   No creation, editing, or deletion permissions
-   **Permissions inherited:** View permissions only

## Usage in Livewire Components

### Using the HasModulePermissions Trait

```php
<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Traits\HasModulePermissions;

class BlogIndex extends Component
{
    use HasModulePermissions;

    public function render()
    {
        // Only show blogs if user can view them through their role
        if (!$this->canView('blog')) {
            abort(403, 'Unauthorized access');
        }

        $blogs = BlogPost::latest()->get();

        return view('livewire.dashboard.blog.index', [
            'blogs' => $blogs,
            'canCreate' => $this->canCreate('blog'),
            'canEdit' => $this->canEdit('blog'),
            'canDelete' => $this->canDelete('blog'),
            'canPublish' => $this->canPublish('blog'),
        ]);
    }
}
```

### Available Methods

-   `hasPermission($permission)` - Check specific permission through roles
-   `canView($module)` - Check view permission through roles
-   `canCreate($module)` - Check create permission through roles
-   `canEdit($module)` - Check edit permission through roles
-   `canDelete($module)` - Check delete permission through roles
-   `canPublish($module)` - Check publish permission through roles
-   `canApprove($module)` - Check approve permission through roles
-   `canUpload($module)` - Check upload permission through roles
-   `getModulePermissions($module)` - Get all permissions for a module through roles
-   `getUserRoles()` - Get user's assigned roles
-   `hasRole($role)` - Check if user has a specific role
-   `hasAnyRole($roles)` - Check if user has any of the given roles
-   `getAllUserPermissions()` - Get all permissions inherited through roles

## Usage in Blade Views

### Blade Directives

```blade
{{-- Check if user can view a module through their role --}}
@canView('blog')
    <div class="blog-section">
        {{-- Blog content --}}
    </div>
@endcanView

{{-- Check if user can create in a module through their role --}}
@canCreate('blog')
    <a href="{{ route('dashboard.blog.create') }}" class="btn btn-primary">
        Create New Post
    </a>
@endcanCreate

{{-- Check if user can edit in a module through their role --}}
@canEdit('blog')
    <a href="{{ route('dashboard.blog.edit', $blog->id) }}" class="btn btn-warning">
        Edit
    </a>
@endcanEdit

{{-- Check if user can delete in a module through their role --}}
@canDelete('blog')
    <button wire:click="delete({{ $blog->id }})" class="btn btn-danger">
        Delete
    </button>
@endcanDelete

{{-- Check if user can publish in a module through their role --}}
@canPublish('blog')
    <button wire:click="publish({{ $blog->id }})" class="btn btn-success">
        Publish
    </button>
@endcanPublish

{{-- Check specific permission through role --}}
@permission('view users')
    <div class="user-management">
        {{-- User management content --}}
    </div>
@endpermission

{{-- Check if user has a specific role --}}
@hasRole('super admin')
    <div class="super-admin-panel">
        {{-- Super admin only content --}}
    </div>
@endhasRole

{{-- Check if user has any of the given roles --}}
@hasAnyRole(['super admin', 'admin'])
    <div class="admin-panel">
        {{-- Admin level features --}}
    </div>
@endhasAnyRole
```

## Middleware Usage

### Route Protection

```php
// In routes/web.php
Route::middleware(['auth', 'module.permission:view blog'])->group(function () {
    Route::get('/dashboard/blog', BlogIndex::class)->name('dashboard.blog.index');
});

Route::middleware(['auth', 'module.permission:create blog'])->group(function () {
    Route::get('/dashboard/blog/create', BlogCreate::class)->name('dashboard.blog.create');
});
```

## Managing Roles and Users

### Assigning Roles to Users

```bash
# Using the command line tool
php artisan user:assign-role user@example.com "super admin"
php artisan user:assign-role user@example.com "admin"
php artisan user:assign-role user@example.com "editor"
php artisan user:assign-role user@example.com "user"
```

```php
// In a controller or seeder
$user = User::find(1);

// Assign a single role (removes other roles)
$user->syncRoles(['editor']);

// Assign multiple roles
$user->syncRoles(['editor', 'admin']);

// Add a role without removing others
$user->assignRole('editor');
```

### Checking Roles and Permissions

```php
// Check if user has a specific role
if ($user->hasRole('super admin')) {
    // User is super admin
}

// Check if user has any of the roles
if ($user->hasAnyRole(['super admin', 'admin'])) {
    // User is super admin or admin
}

// Check if user has permission through their role
if ($user->hasPermissionTo('view blog')) {
    // User can view blog through their role
}

// Get all permissions inherited through roles
$permissions = $user->getAllPermissions();
```

## Best Practices

1. **Always assign roles to users** (not individual permissions)
2. **Use the trait** in Livewire components for consistent permission checking
3. **Use Blade directives** in views for clean, readable code
4. **Protect routes** with middleware for security
5. **Regularly audit** role assignments to ensure proper access control
6. **Use role-based permissions** for common access patterns
7. **Document custom roles** when adding new ones
8. **Limit super admin access** to only trusted individuals
9. **Use admin role** for department heads and senior staff
10. **Use editor role** for content creators and teachers
11. **Keep roles simple** - avoid creating too many specialized roles
12. **Test role assignments** regularly to ensure proper inheritance

## Adding New Roles

To add a new role:

1. Add the role to the `RoleSeeder.php` file
2. Define the permissions for the new role
3. Run the seeder: `php artisan db:seed --class=RoleSeeder`
4. Use the role in your components and views

## Security Notes

-   **Permissions are inherited through roles** - users don't have direct permissions
-   Always validate permissions in controllers/Livewire components
-   Use middleware for route-level protection
-   Regularly review and update role assignments
-   Log role-related activities for audit purposes
-   Super admin should be used sparingly and only for system administration
-   Admin role provides full content management without system-level access
-   **Role changes affect all users** with that role immediately
