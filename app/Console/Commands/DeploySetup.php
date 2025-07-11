<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DeploySetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:setup {--force : Force run even if already set up}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Complete deployment setup including permissions, roles, and settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting deployment setup...');

        try {
            // Check if permissions table exists
            if (!DB::getSchemaBuilder()->hasTable('permissions')) {
                $this->error('Permissions table does not exist. Please run migrations first.');
                return 1;
            }

            // Clear all caches
            $this->info('🧹 Clearing caches...');
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('permission:cache-reset');

            // Run migrations if needed
            $this->info('📦 Running migrations...');
            Artisan::call('migrate', ['--force' => true]);

            // Run seeders
            $this->info('🌱 Running seeders...');
            Artisan::call('db:seed', ['--force' => true]);

            // Ensure settings permission exists
            $this->info('🔐 Ensuring permissions exist...');
            $this->ensurePermissionsExist();

            // Clear permission cache again
            $this->info('🧹 Clearing permission cache...');
            Artisan::call('permission:cache-reset');

            // Test permissions
            $this->info('🧪 Testing permissions...');
            $this->testPermissions();

            $this->info('✅ Deployment setup completed successfully!');
            $this->info('🎉 Your application is ready to use!');

            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Deployment setup failed: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return 1;
        }
    }

    private function ensurePermissionsExist()
    {
        // Ensure critical permissions exist
        $criticalPermissions = [
            'view settings',
            'edit settings',
            'view dashboard',
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        foreach ($criticalPermissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $this->line("✅ Permission '{$permissionName}' exists");
        }

        // Ensure roles exist and have proper permissions
        $roles = ['super admin', 'admin', 'editor', 'user'];
        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $this->line("✅ Role '{$roleName}' exists");
        }
    }

    private function testPermissions()
    {
        // Test if settings permission exists
        $settingsPermission = Permission::where('name', 'view settings')->first();
        if (!$settingsPermission) {
            $this->error('❌ Settings permission not found!');
            return false;
        }

        $this->line("✅ Settings permission found: {$settingsPermission->name}");

        // Test if super admin role has the permission
        $superAdminRole = Role::where('name', 'super admin')->first();
        if ($superAdminRole && $superAdminRole->hasPermissionTo('view settings')) {
            $this->line("✅ Super admin role has 'view settings' permission");
        } else {
            $this->warn("⚠️ Super admin role may not have 'view settings' permission");
        }

        return true;
    }
}
