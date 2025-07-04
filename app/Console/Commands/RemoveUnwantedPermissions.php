<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RemoveUnwantedPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:remove-unwanted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove unwanted permissions (settings, reports, admissions, dashboard)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Current permissions in the system:');
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $this->line("- {$permission->name}");
        }

        $this->newLine();

        // Permissions to remove
        $unwantedPermissions = [
            'view settings',
            'create settings',
            'edit settings',
            'delete settings',
            'view reports',
            'create reports',
            'edit reports',
            'delete reports',
            'generate reports',
            'export reports',
            'view admissions',
            'create admissions',
            'edit admissions',
            'delete admissions',
            'approve admissions',
            'view dashboard'
        ];

        $removedCount = 0;
        foreach ($unwantedPermissions as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();
            if ($permission) {
                $this->warn("Removing permission: {$permissionName}");
                $permission->delete();
                $this->info("✓ Removed permission: {$permissionName}");
                $removedCount++;
            } else {
                $this->line("Permission '{$permissionName}' not found - skipping");
            }
        }

        $this->newLine();
        $this->info("Removed {$removedCount} unwanted permissions");

        $this->newLine();
        $this->info('Remaining permissions after cleanup:');
        $remainingPermissions = Permission::all();
        foreach ($remainingPermissions as $permission) {
            $this->line("- {$permission->name}");
        }

        $this->info('Permission cleanup completed!');
    }
}
