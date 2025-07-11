# Deployment Guide - St. Aloysius School Management System

## Overview

This guide helps you properly deploy the St. Aloysius School Management System and resolve common permission issues that may occur during deployment.

## Common Deployment Issues

### Issue: "There is no permission named `view settings` for guard `web`"

This error occurs when:

1. **Permission cache is stale** after seeding
2. **Seeder didn't run completely** during deployment
3. **Database transaction issues** during seeding
4. **Guard name mismatch** in permission configuration

## Quick Fix Commands

### Option 1: Use the Fix Command (Recommended)

```bash
php artisan fix:settings-permission
```

### Option 2: Use the Full Deployment Setup

```bash
php artisan deploy:setup
```

### Option 3: Manual Fix

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan permission:cache-reset

# Run seeders
php artisan db:seed --force

# Clear permission cache again
php artisan permission:cache-reset
```

## Complete Deployment Process

### Step 1: Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
```

### Step 2: Database Setup

```bash
# Run migrations
php artisan migrate --force

# Run the deployment setup (recommended)
php artisan deploy:setup
```

### Step 3: Verify Setup

```bash
# Test if permissions work
php artisan tinker
```

In tinker, run:

```php
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// Check if settings permission exists
Permission::where('name', 'view settings')->first();

// Check if super admin role has the permission
Role::where('name', 'super admin')->first()->hasPermissionTo('view settings');
```

## Troubleshooting

### Permission Cache Issues

If you're still getting permission errors after running the fix commands:

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan permission:cache-reset

# Restart your web server
sudo systemctl restart apache2  # or nginx
```

### Database Issues

If the database is in an inconsistent state:

```bash
# Reset database (WARNING: This will delete all data)
php artisan migrate:fresh --seed

# Or run the deployment setup
php artisan deploy:setup
```

### User Role Issues

If users don't have proper roles:

```bash
# Make the first user super admin
php artisan db:seed --class=SuperAdminSeeder

# Or manually assign roles in tinker
php artisan tinker
```

In tinker:

```php
use App\Models\User;
use Spatie\Permission\Models\Role;

$user = User::first();
$superAdminRole = Role::where('name', 'super admin')->first();
$user->assignRole($superAdminRole);
```

## Production Deployment Checklist

-   [ ] Environment file configured
-   [ ] Database migrations run
-   [ ] Seeders executed successfully
-   [ ] Permission cache cleared
-   [ ] File permissions set correctly
-   [ ] Web server configured
-   [ ] SSL certificate installed (if needed)
-   [ ] Backup system configured

## Commands Reference

### Permission Management

```bash
# Clear permission cache
php artisan permission:cache-reset

# List all permissions
php artisan tinker
Permission::all()->pluck('name');

# List all roles
php artisan tinker
Role::all()->pluck('name');
```

### User Management

```bash
# Create a new user
php artisan tinker
User::create(['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);

# Assign role to user
php artisan tinker
$user = User::where('email', 'admin@example.com')->first();
$user->assignRole('super admin');
```

### Testing Permissions

```bash
# Test if a user has permission
php artisan tinker
$user = User::first();
$user->hasPermissionTo('view settings');
$user->hasRole('super admin');
```

## Support

If you continue to experience issues:

1. Check the Laravel logs: `storage/logs/laravel.log`
2. Check the permission tables in your database
3. Verify the guard configuration in `config/auth.php`
4. Ensure the Spatie Permission package is properly installed

## Security Notes

-   Always use strong passwords in production
-   Limit super admin access to trusted individuals only
-   Regularly review user roles and permissions
-   Keep your application and dependencies updated
-   Monitor logs for suspicious activity
