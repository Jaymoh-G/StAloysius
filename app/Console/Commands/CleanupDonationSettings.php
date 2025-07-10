<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class CleanupDonationSettings extends Command
{
    protected $signature = 'settings:cleanup-donation';
    protected $description = 'Clean up donation settings to keep only essential fields';

    public function handle()
    {
        $this->info('Cleaning up donation settings...');

        // Remove all existing donation settings
        Setting::where('group', 'donation')->delete();

        $this->info('Removed all existing donation settings.');

        // Add only the essential settings
        $essentialSettings = [
            'donation_banner' => ['Donation Banner Image', 'donation', 'file'],
            'donation_external_link' => ['External Donation Link', 'donation', 'url'],
            'bank_account_name' => ['Bank Account Name', 'donation', 'text'],
            'bank_account_number' => ['Bank Account Number', 'donation', 'text'],
            'bank_name' => ['Bank Name', 'donation', 'text'],
            'bank_branch' => ['Bank Branch', 'donation', 'text'],
            'mpesa_paybill' => ['M-Pesa Paybill Number', 'donation', 'text'],
            'mpesa_account_number' => ['M-Pesa Account Number', 'donation', 'text'],
        ];

        foreach ($essentialSettings as $key => $data) {
            Setting::set($key, '', 'donation', $data[2], $data[0], $data[1]);
        }

        $this->info('Added essential donation settings:');
        foreach ($essentialSettings as $key => $data) {
            $this->line("  - {$data[0]} ({$data[2]})");
        }

        $this->info('Donation settings cleanup completed!');
    }
}
