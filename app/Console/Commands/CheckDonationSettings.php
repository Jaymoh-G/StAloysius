<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class CheckDonationSettings extends Command
{
    protected $signature = 'settings:check-donation';
    protected $description = 'Check what donation settings are in the database';

    public function handle()
    {
        $this->info('Checking Donation Settings:');
        $donationSettings = Setting::where('group', 'donation')->orderBy('key')->get(['key', 'label', 'type']);

        if ($donationSettings->count() > 0) {
            foreach ($donationSettings as $setting) {
                $this->line("  {$setting->key} - {$setting->label} ({$setting->type})");
            }
        } else {
            $this->line("  No donation settings found.");
        }
    }
}
