<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remove old roles that are no longer needed
        $oldRoles = ['teacher', 'student'];
        foreach ($oldRoles as $oldRole) {
            $role = Role::where('name', $oldRole)->first();
            if ($role) {
                $role->delete();
                $this->command->info("Removed old role: {$oldRole}");
            }
        }

        // Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Define modules and their permissions
        $modules = [

            'users' => ['view', 'create', 'edit', 'delete'],
            'roles' => ['view', 'create', 'edit', 'delete'],
            'permissions' => ['view', 'create', 'edit', 'delete'],
            'blog' => ['view', 'create', 'edit', 'delete', 'publish'],
            'events' => ['view', 'create', 'edit', 'delete', 'publish'],
            'departments' => ['view', 'create', 'edit', 'delete'],
            'facilities' => ['view', 'create', 'edit', 'delete'],
            'testimonials' => ['view', 'create', 'edit', 'delete', 'approve'],
            'gallery' => ['view', 'create', 'edit', 'delete', 'upload'],
            'careers' => ['view', 'create', 'edit', 'delete', 'publish'],
            'static_pages' => ['view', 'create', 'edit', 'delete'],
            'team' => ['view', 'create', 'edit', 'delete'],
            'youtube' => ['view', 'create', 'edit', 'delete'],
            'projects' => ['view', 'create', 'edit', 'delete', 'publish'],

        ];

        // Create all permissions
        $allPermissions = [];
        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $permissionName = $action . ' ' . $module;
                $allPermissions[] = $permissionName;
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        // Clear existing permissions from roles
        $superAdminRole->syncPermissions([]);
        $adminRole->syncPermissions([]);
        $editorRole->syncPermissions([]);
        $userRole->syncPermissions([]);

        // Assign permissions to Super Admin (ALL permissions)
        $superAdminRole->givePermissionTo($allPermissions);

        // Assign permissions to Admin (everything except role/permission management)
        $adminPermissions = array_filter($allPermissions, function ($permission) {
            return !str_contains($permission, 'roles') && !str_contains($permission, 'permissions');
        });
        $adminRole->givePermissionTo($adminPermissions);

        // Assign permissions to Editor (content management only)
        $editorPermissions = [

            'view blog',
            'create blog',
            'edit blog',
            'publish blog',
            'view events',
            'create events',
            'edit events',
            'publish events',
            'view departments',
            'create departments',
            'edit departments',
            'view facilities',
            'create facilities',
            'edit facilities',
            'view testimonials',
            'create testimonials',
            'edit testimonials',

            'view gallery',
            'create gallery',
            'edit gallery',
            'upload gallery',
            'view careers',
            'create careers',
            'edit careers',
            'publish careers',
            'view static_pages',
            'create static_pages',
            'edit static_pages',
            'view team',
            'create team',
            'edit team',
            'view youtube',
            'create youtube',
            'edit youtube',
            'view projects',
            'create projects',
            'edit projects',
            'publish projects',

        ];
        $editorRole->givePermissionTo($editorPermissions);

        // Assign permissions to User (view only)
        $userPermissions = [
            'view blog',
            'view events',
            'view gallery',
            'view testimonials',
            'view careers',
            'view static_pages',
            'view team',
            'view youtube',
            'view departments',
            'view facilities',
            'view projects',
        ];
        $userRole->givePermissionTo($userPermissions);

        $this->command->info('Roles and permissions created successfully!');
        $this->command->info('Super Admin: ' . count($allPermissions) . ' permissions');
        $this->command->info('Admin: ' . count($adminPermissions) . ' permissions');
        $this->command->info('Editor: ' . count($editorPermissions) . ' permissions');
        $this->command->info('User: ' . count($userPermissions) . ' permissions');
    }
}
