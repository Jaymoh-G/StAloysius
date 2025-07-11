<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DebugPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:permissions {--user= : Check specific user by email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug permission issues and show current state';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Debugging permissions...');

        // Check if permissions table exists
        if (!Schema::hasTable('permissions')) {
            $this->error('❌ Permissions table does not exist!');
            return 1;
        }

        // Show all permissions
        $this->info('📋 All Permissions:');
        $permissions = Permission::all();
        if ($permissions->isEmpty()) {
            $this->warn('⚠️ No permissions found in database');
        } else {
            foreach ($permissions as $permission) {
                $this->line("  - {$permission->name} (ID: {$permission->id}, Guard: {$permission->guard_name})");
            }
        }

        $this->newLine();

        // Show all roles
        $this->info('👥 All Roles:');
        $roles = Role::all();
        if ($roles->isEmpty()) {
            $this->warn('⚠️ No roles found in database');
        } else {
            foreach ($roles as $role) {
                $this->line("  - {$role->name} (ID: {$role->id}, Guard: {$role->guard_name})");
                $rolePermissions = $role->permissions->pluck('name')->toArray();
                if (!empty($rolePermissions)) {
                    $this->line("    Permissions: " . implode(', ', $rolePermissions));
                } else {
                    $this->line("    Permissions: None");
                }
            }
        }

        $this->newLine();

        // Check specific settings permission
        $this->info('🔧 Settings Permission Check:');
        $settingsPermission = Permission::where('name', 'view settings')->first();
        if ($settingsPermission) {
            $this->line("✅ 'view settings' permission exists");
            $this->line("  ID: {$settingsPermission->id}");
            $this->line("  Guard: {$settingsPermission->guard_name}");

            // Check which roles have this permission
            $rolesWithPermission = Role::whereHas('permissions', function ($query) {
                $query->where('name', 'view settings');
            })->get();

            if ($rolesWithPermission->isNotEmpty()) {
                $this->line("  Roles with this permission:");
                foreach ($rolesWithPermission as $role) {
                    $this->line("    - {$role->name}");
                }
            } else {
                $this->warn("  ⚠️ No roles have 'view settings' permission!");
            }
        } else {
            $this->error("❌ 'view settings' permission does not exist!");
        }

        $this->newLine();

        // Check users
        $this->info('👤 Users Check:');
        $users = User::all();
        if ($users->isEmpty()) {
            $this->warn('⚠️ No users found in database');
        } else {
            foreach ($users as $user) {
                $this->line("  - {$user->name} ({$user->email})");
                $userRoles = $user->roles->pluck('name')->toArray();
                $userPermissions = $user->permissions->pluck('name')->toArray();

                if (!empty($userRoles)) {
                    $this->line("    Roles: " . implode(', ', $userRoles));
                } else {
                    $this->line("    Roles: None");
                }

                if (!empty($userPermissions)) {
                    $this->line("    Direct Permissions: " . implode(', ', $userPermissions));
                }

                // Check if user can access settings
                if ($user->hasPermissionTo('view settings')) {
                    $this->line("    ✅ Can access settings");
                } else {
                    $this->line("    ❌ Cannot access settings");
                }
            }
        }

        // Check specific user if provided
        if ($email = $this->option('user')) {
            $this->newLine();
            $this->info("🔍 Checking specific user: {$email}");

            $user = User::where('email', $email)->first();
            if ($user) {
                $this->line("User found: {$user->name}");
                $this->line("Roles: " . implode(', ', $user->roles->pluck('name')->toArray()));
                $this->line("Direct permissions: " . implode(', ', $user->permissions->pluck('name')->toArray()));
                $this->line("All permissions (inherited): " . implode(', ', $user->getAllPermissions()->pluck('name')->toArray()));

                if ($user->hasPermissionTo('view settings')) {
                    $this->line("✅ User can access settings");
                } else {
                    $this->line("❌ User cannot access settings");
                }
            } else {
                $this->error("User with email '{$email}' not found");
            }
        }

        $this->newLine();
        $this->info('🔍 Debug complete!');

        return 0;
    }
}
