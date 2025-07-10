<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class UpdateLinkSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:update-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update link settings to use new naming convention';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating link settings...');

        // Update Quick Links
        $this->updateQuickLinks();

        // Update Resource Links
        $this->updateResourceLinks();

        $this->info('Link settings updated successfully!');
    }

    private function updateQuickLinks()
    {
        $this->info('Updating Quick Links...');

        // Delete old quick link settings
        Setting::where('group', 'quick_links')
            ->whereIn('key', [
                'quick_link_1_name',
                'quick_link_1_url',
                'quick_link_2_name',
                'quick_link_2_url',
                'quick_link_3_name',
                'quick_link_3_url',
                'quick_link_4_name',
                'quick_link_4_url',
                'quick_link_5_name',
                'quick_link_5_url'
            ])
            ->delete();

        // Add new quick link settings
        for ($i = 1; $i <= 7; $i++) {
            Setting::set("link_{$i}", '', 'quick_links', 'text', "Link {$i}", 'quick_links');
            Setting::set("link_{$i}_url", '', 'quick_links', 'url', "Link {$i} URL", 'quick_links');
        }
    }

    private function updateResourceLinks()
    {
        $this->info('Updating Resource Links...');

        // Delete old resource link settings
        Setting::where('group', 'resource_links')
            ->whereIn('key', [
                'resource_link_1_name',
                'resource_link_1_url',
                'resource_link_2_name',
                'resource_link_2_url',
                'resource_link_3_name',
                'resource_link_3_url',
                'resource_link_4_name',
                'resource_link_4_url',
                'resource_link_5_name',
                'resource_link_5_url',
                'link_1',
                'link_1_url',
                'link_2',
                'link_2_url',
                'link_3',
                'link_3_url',
                'link_4',
                'link_4_url',
                'link_5',
                'link_5_url',
                'link_6',
                'link_6_url',
                'link_7',
                'link_7_url'
            ])
            ->delete();

        // Add new resource link settings
        for ($i = 1; $i <= 7; $i++) {
            Setting::set("resource_link_{$i}", '', 'resource_links', 'text', "Link {$i}", 'resource_links');
            Setting::set("resource_link_{$i}_url", '', 'resource_links', 'url', "Link {$i} URL", 'resource_links');
        }
    }
}
