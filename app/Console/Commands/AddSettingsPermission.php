<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class AddSettingsPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:add-settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add settings permission to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $permission = Permission::firstOrCreate(['name' => 'view settings']);

        $this->info('Settings permission created successfully!');
        $this->info('Permission name: view settings');

        return 0;
    }
}
