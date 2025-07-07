<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if super admin role exists
        $superAdminRole = Role::where('name', 'super admin')->first();
        if (!$superAdminRole) {
            $this->command->error('Super admin role not found. Please run RoleSeeder first.');
            return;
        }

        // Get the first user
        $firstUser = User::first();
        if (!$firstUser) {
            $this->command->error('No users found in the system. Please create a user first.');
            return;
        }

        // Check if user already has super admin role
        if ($firstUser->hasRole('super admin')) {
            $this->command->info("User '{$firstUser->email}' is already a super admin.");
            return;
        }

        // Remove all existing roles and assign super admin role
        $firstUser->syncRoles(['super admin']);

        $this->command->info("✅ Successfully made user '{$firstUser->email}' a super admin!");

        $permissionCount = $firstUser->getAllPermissions()->count();
        $this->command->info("User inherits {$permissionCount} permissions through their role(s)");

        $this->command->info('🎉 Super admin setup complete!');
    }
}
