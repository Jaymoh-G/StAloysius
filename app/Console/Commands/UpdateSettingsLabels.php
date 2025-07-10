<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class UpdateSettingsLabels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:update-labels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update settings labels for menu images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Update main_menu_logo_1 label
        $logo1 = Setting::where('key', 'main_menu_logo_1')->first();
        if ($logo1) {
            $logo1->update(['label' => 'Menu Image 1']);
            $this->info('Updated main_menu_logo_1 label to "Menu Image 1"');
        }

        // Update main_menu_logo_2 label
        $logo2 = Setting::where('key', 'main_menu_logo_2')->first();
        if ($logo2) {
            $logo2->update(['label' => 'Menu Image 2']);
            $this->info('Updated main_menu_logo_2 label to "Menu Image 2"');
        }

        $this->info('Settings labels updated successfully!');

        return 0;
    }
}
