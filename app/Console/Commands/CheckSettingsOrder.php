<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class CheckSettingsOrder extends Command
{
    protected $signature = 'settings:check-order';
    protected $description = 'Check the order of settings in the database';

    public function handle()
    {
        $this->info('Checking Quick Links order:');
        $quickLinks = Setting::where('group', 'quick_links')->orderBy('key')->get(['key', 'label']);
        foreach ($quickLinks as $setting) {
            $this->line("  {$setting->key} - {$setting->label}");
        }

        $this->info('Checking Resource Links order:');
        $resourceLinks = Setting::where('group', 'resource_links')->orderBy('key')->get(['key', 'label']);
        foreach ($resourceLinks as $setting) {
            $this->line("  {$setting->key} - {$setting->label}");
        }
    }
}
