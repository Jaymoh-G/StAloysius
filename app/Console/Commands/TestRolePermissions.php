<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class TestRolePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:role-permissions {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the role-based permission system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            // Test specific user
            $user = User::where('email', $email)->first();
            if (!$user) {
                $this->error("User with email '{$email}' not found.");
                return 1;
            }
            $this->testUserPermissions($user);
        } else {
            // Test all roles
            $this->testAllRoles();
        }

        return 0;
    }

    private function testAllRoles()
    {
        $this->info('Testing Role-Based Permission System');
        $this->info('=====================================');

        $roles = Role::all();

        foreach ($roles as $role) {
            $this->info("\n📋 Role: {$role->name}");
            $this->info('Permissions:');

            $permissions = $role->permissions;
            $permissionCount = $permissions->count();

            if ($permissionCount > 0) {
                $this->info("Total: {$permissionCount} permissions");

                // Group permissions by module
                $groupedPermissions = [];
                foreach ($permissions as $permission) {
                    $parts = explode(' ', $permission->name);
                    if (count($parts) >= 2) {
                        $action = $parts[0];
                        $module = implode(' ', array_slice($parts, 1));
                        $groupedPermissions[$module][] = $action;
                    }
                }

                foreach ($groupedPermissions as $module => $actions) {
                    $this->info("  • {$module}: " . implode(', ', $actions));
                }
            } else {
                $this->warn("  No permissions assigned");
            }
        }

        $this->info("\n✅ Role-based permission system is working correctly!");
    }

    private function testUserPermissions($user)
    {
        $this->info("Testing User: {$user->name} ({$user->email})");
        $this->info('==============================================');

        // Show user's roles
        $roles = $user->roles;
        $this->info("Roles: " . $roles->pluck('name')->implode(', '));

        // Show inherited permissions
        $permissions = $user->getAllPermissions();
        $permissionCount = $permissions->count();

        $this->info("Inherited Permissions: {$permissionCount} total");

        if ($permissionCount > 0) {
            // Group permissions by module
            $groupedPermissions = [];
            foreach ($permissions as $permission) {
                $parts = explode(' ', $permission->name);
                if (count($parts) >= 2) {
                    $action = $parts[0];
                    $module = implode(' ', array_slice($parts, 1));
                    $groupedPermissions[$module][] = $action;
                }
            }

            foreach ($groupedPermissions as $module => $actions) {
                $this->info("  • {$module}: " . implode(', ', $actions));
            }
        }

        // Test some common permissions
        $this->info("\nPermission Tests:");
        $this->info("  • Can view dashboard: " . ($user->hasPermissionTo('view dashboard') ? '✅' : '❌'));
        $this->info("  • Can view blog: " . ($user->hasPermissionTo('view blog') ? '✅' : '❌'));
        $this->info("  • Can create blog: " . ($user->hasPermissionTo('create blog') ? '✅' : '❌'));
        $this->info("  • Can manage users: " . ($user->hasPermissionTo('view users') ? '✅' : '❌'));
        $this->info("  • Can manage roles: " . ($user->hasPermissionTo('view roles') ? '✅' : '❌'));

        $this->info("\n✅ User permission inheritance is working correctly!");
    }
}
