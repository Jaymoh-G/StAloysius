<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a user by email (permissions are inherited through roles)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $roleName = $this->argument('role');

        // Find the user
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }

        // Check if role exists
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error("Role '{$roleName}' not found. Available roles: " . Role::pluck('name')->implode(', '));
            return 1;
        }

        // Remove all existing roles and assign the new role
        $user->syncRoles([$roleName]);

        $this->info("Successfully assigned role '{$roleName}' to user '{$email}'");

        // Show user's current roles and inherited permissions
        $currentRoles = $user->roles->pluck('name')->implode(', ');
        $this->info("User's current roles: {$currentRoles}");

        $permissionCount = $user->getAllPermissions()->count();
        $this->info("User inherits {$permissionCount} permissions through their role(s)");

        return 0;
    }
}
