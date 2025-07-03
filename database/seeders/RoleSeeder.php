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
        // Create roles (or get existing ones)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create permissions
        $permissions = [
            'view dashboard',
            'manage users',
            'manage roles',
            'manage permissions',
            'manage blog posts',
            'manage events',
            'manage departments',
            'manage facilities',
            'manage testimonials',
            'manage gallery',
            'manage careers',
            'manage static pages',
            'manage team',
            'manage youtube',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to admin
        $adminRole->givePermissionTo(Permission::all());

        // Assign limited permissions to editor
        $editorRole->givePermissionTo([
            'view dashboard',
            'manage blog posts',
            'manage events',
            'manage departments',
            'manage facilities',
            'manage testimonials',
            'manage gallery',
            'manage careers',
            'manage static pages',
            'manage team',
            'manage youtube',
        ]);

        // Assign basic permissions to user
        $userRole->givePermissionTo([
            'view dashboard',
        ]);
    }
}
