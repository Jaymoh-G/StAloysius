# Super Admin Setup Guide

This guide explains how to set up the first user as a super admin in the St. Aloysius School Management System.

## What is a Super Admin?

A **Super Admin** has full access to all system features including:

-   All module permissions (view, create, edit, delete, publish, etc.)
-   User management
-   Role and permission management
-   System administration
-   Complete control over the application

## Setup Methods

### Method 1: Using the Command Line (Recommended)

If you already have a user in the system, you can make them a super admin using the command line:

```bash
# Make the first user in the system a super admin
php artisan user:make-super-admin

# Or specify a specific user by email
php artisan user:make-super-admin user@example.com
```

### Method 2: Using Database Seeding

If you're setting up the system for the first time, you can use database seeding:

```bash
# This will create roles, permissions, and make the first user a super admin
php artisan db:seed

# Or run specific seeders
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=SuperAdminSeeder
```

### Method 3: Using the Existing Role Assignment Command

You can also use the general role assignment command:

```bash
# Assign super admin role to a specific user
php artisan user:assign-role user@example.com "super admin"
```

## Verification

After setting up the super admin, you can verify it worked by:

1. **Logging into the dashboard** - You should see all modules available
2. **Checking the user info panel** - It should show "Super Admin" role
3. **Accessing role management** - You should be able to view and edit roles
4. **Running the test command**:
    ```bash
    php artisan permissions:test
    ```

## Available Commands

-   `php artisan user:make-super-admin [email]` - Make first user (or specified user) super admin
-   `php artisan user:assign-role {email} {role}` - Assign any role to a user
-   `php artisan permissions:test` - Test the permission system
-   `php artisan db:seed --class=RoleSeeder` - Create roles and permissions
-   `php artisan db:seed --class=SuperAdminSeeder` - Make first user super admin

## Security Notes

⚠️ **Important Security Considerations:**

1. **Limit super admin access** - Only trusted individuals should have super admin role
2. **Use admin role for department heads** - The admin role provides full content management without system-level access
3. **Regular audits** - Periodically review who has super admin access
4. **Strong passwords** - Ensure super admin accounts have strong passwords
5. **Monitor activity** - Super admin actions are logged in the activity timeline

## Role Hierarchy

The system uses this role hierarchy:

1. **Super Admin** - Full system access (including role/permission management)
2. **Admin** - Full content management + user management (no role/permission management)
3. **Editor** - Content creation and editing
4. **User** - View-only access

## Troubleshooting

### "Super admin role not found"

Run the role seeder first:

```bash
php artisan db:seed --class=RoleSeeder
```

### "No users found in the system"

Create a user first, then run the super admin setup:

```bash
php artisan db:seed --class=DatabaseSeeder
```

### "User already has super admin role"

The user is already set up correctly. No action needed.

### Permission issues after setup

Clear the permission cache:

```bash
php artisan permission:cache-reset
```

## Next Steps

After setting up the super admin:

1. **Create additional users** for your team
2. **Assign appropriate roles** to each user
3. **Configure system settings** as needed
4. **Start creating content** for your school website

For more information about roles and permissions, see the [PERMISSIONS.md](PERMISSIONS.md) file.
