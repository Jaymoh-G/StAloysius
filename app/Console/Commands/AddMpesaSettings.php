<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class AddMpesaSettings extends Command
{
    protected $signature = 'settings:add-mpesa';
    protected $description = 'Add M-Pesa payment settings to the database';

    public function handle()
    {
        $this->info('Adding M-Pesa payment settings...');

        // Add M-Pesa settings
        Setting::set('mpesa_account_name', 'Christian Life Community', 'donation', 'text', 'M-Pesa Account Name', 'donation');
        Setting::set('mpesa_paybill', '880100', 'donation', 'text', 'M-Pesa Paybill Number', 'donation');
        Setting::set('mpesa_account_number', '6494410018', 'donation', 'text', 'M-Pesa Account Number', 'donation');

        $this->info('M-Pesa settings added successfully!');
    }
}
