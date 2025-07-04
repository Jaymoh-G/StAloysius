<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class RemoveUnwantedRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:remove-unwanted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove unwanted roles (settings, admissions, reports)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Current roles in the system:');
        $roles = Role::all();
        foreach ($roles as $role) {
            $this->line("- {$role->name} ({$role->permissions->count()} permissions)");
        }

        $this->newLine();

        // Roles to remove
        $unwantedRoles = ['settings', 'admissions', 'reports'];

        foreach ($unwantedRoles as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $this->warn("Removing role: {$roleName}");
                $role->delete();
                $this->info("✓ Removed role: {$roleName}");
            } else {
                $this->line("Role '{$roleName}' not found - skipping");
            }
        }

        $this->newLine();
        $this->info('Remaining roles after cleanup:');
        $remainingRoles = Role::all();
        foreach ($remainingRoles as $role) {
            $this->line("- {$role->name} ({$role->permissions->count()} permissions)");
        }

        $this->info('Role cleanup completed!');
    }
}
