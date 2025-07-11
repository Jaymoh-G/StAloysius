<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FixSettingsPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:settings-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix the settings permission issue by ensuring it exists and is properly assigned';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Fixing settings permission...');

        try {
            // Clear permission cache first
            $this->info('🧹 Clearing permission cache...');
            Artisan::call('permission:cache-reset');

            // Ensure settings permissions exist
            $this->info('🔐 Creating settings permissions...');
            $viewSettings = Permission::firstOrCreate(['name' => 'view settings']);
            $editSettings = Permission::firstOrCreate(['name' => 'edit settings']);

            $this->line("✅ Permission 'view settings' created/found");
            $this->line("✅ Permission 'edit settings' created/found");

            // Ensure roles exist
            $this->info('👥 Ensuring roles exist...');
            $superAdminRole = Role::firstOrCreate(['name' => 'super admin']);
            $adminRole = Role::firstOrCreate(['name' => 'admin']);
            $editorRole = Role::firstOrCreate(['name' => 'editor']);
            $userRole = Role::firstOrCreate(['name' => 'user']);

            // Assign settings permissions to all roles
            $this->info('🔗 Assigning settings permissions to roles...');

            $superAdminRole->givePermissionTo(['view settings', 'edit settings']);
            $adminRole->givePermissionTo(['view settings', 'edit settings']);
            $editorRole->givePermissionTo(['view settings', 'edit settings']);
            $userRole->givePermissionTo(['view settings']);

            $this->line("✅ Settings permissions assigned to all roles");

            // Clear permission cache again
            $this->info('🧹 Clearing permission cache again...');
            Artisan::call('permission:cache-reset');

            // Test the permission
            $this->info('🧪 Testing settings permission...');
            $testPermission = Permission::where('name', 'view settings')->first();

            if ($testPermission) {
                $this->line("✅ Settings permission test passed");
                $this->line("Permission ID: {$testPermission->id}");
                $this->line("Permission Name: {$testPermission->name}");
                $this->line("Guard Name: {$testPermission->guard_name}");
            } else {
                $this->error("❌ Settings permission test failed");
                return 1;
            }

            // Test role permissions
            if ($superAdminRole->hasPermissionTo('view settings')) {
                $this->line("✅ Super admin role has 'view settings' permission");
            } else {
                $this->error("❌ Super admin role missing 'view settings' permission");
                return 1;
            }

            $this->info('✅ Settings permission fix completed successfully!');
            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Settings permission fix failed: ' . $e->getMessage());
            return 1;
        }
    }
}
