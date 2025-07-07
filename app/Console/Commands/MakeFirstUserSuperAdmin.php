<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class MakeFirstUserSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make-super-admin {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make the first user (or specified user) a super admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            // Find user by email
            $user = User::where('email', $email)->first();
            if (!$user) {
                $this->error("User with email '{$email}' not found.");
                return 1;
            }
        } else {
            // Get the first user
            $user = User::first();
            if (!$user) {
                $this->error("No users found in the system. Please create a user first.");
                return 1;
            }
        }

        // Check if super admin role exists
        $superAdminRole = Role::where('name', 'super admin')->first();
        if (!$superAdminRole) {
            $this->error("Super admin role not found. Please run 'php artisan db:seed --class=RoleSeeder' first.");
            return 1;
        }

        // Check if user already has super admin role
        if ($user->hasRole('super admin')) {
            $this->info("User '{$user->email}' is already a super admin.");
            return 0;
        }

        // Remove all existing roles and assign super admin role
        $user->syncRoles(['super admin']);

        $this->info("✅ Successfully made user '{$user->email}' a super admin!");

        // Show user's current roles and inherited permissions
        $currentRoles = $user->roles->pluck('name')->implode(', ');
        $this->info("User's current roles: {$currentRoles}");

        $permissionCount = $user->getAllPermissions()->count();
        $this->info("User inherits {$permissionCount} permissions through their role(s)");

        $this->info("\n🎉 Super admin setup complete! User '{$user->email}' now has full system access.");
        $this->info("This includes:");
        $this->info("  • All module permissions (view, create, edit, delete, publish, etc.)");
        $this->info("  • User management");
        $this->info("  • Role and permission management");
        $this->info("  • System administration");

        return 0;
    }
}
