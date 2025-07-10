<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class UpdateDonationSettings extends Command
{
    protected $signature = 'settings:update-donation';
    protected $description = 'Update donation settings to include bank details and simplified structure';

    public function handle()
    {
        $this->info('Updating donation settings...');

        // Remove old settings
        Setting::where('group', 'donation')
            ->whereIn('key', [
                'donation_link',
                'mpesa_account_name'
            ])
            ->delete();

        // Add/Update new settings
        $donationSettings = [
            'donation_banner' => ['Donation Banner Image', 'donation', 'file'],
            'donation_external_link' => ['External Donation Link', 'donation', 'url'],
            'bank_account_name' => ['Bank Account Name', 'donation', 'text'],
            'bank_account_number' => ['Bank Account Number', 'donation', 'text'],
            'bank_name' => ['Bank Name', 'donation', 'text'],
            'bank_branch' => ['Bank Branch', 'donation', 'text'],
            'mpesa_paybill' => ['M-Pesa Paybill Number', 'donation', 'text'],
            'mpesa_account_number' => ['M-Pesa Account Number', 'donation', 'text'],
        ];

        foreach ($donationSettings as $key => $data) {
            Setting::set($key, '', 'donation', $data[2], $data[0], $data[1]);
        }

        $this->info('Donation settings updated successfully!');
    }
}
