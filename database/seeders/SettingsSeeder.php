<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Social Media Settings
        $socialSettings = [
            'facebook' => ['Facebook Page URL', 'socials', 'url'],
            'twitter' => ['Twitter/X Profile URL', 'socials', 'url'],
            'instagram' => ['Instagram Profile URL', 'socials', 'url'],
            'linkedin' => ['LinkedIn Profile/Page URL', 'socials', 'url'],
            'youtube' => ['YouTube Channel URL', 'socials', 'url'],
            'tiktok' => ['TikTok Profile URL', 'socials', 'url'],
            'whatsapp' => ['WhatsApp Link (e.g., https://wa.me/2547XXXXXXX)', 'socials', 'url'],
        ];

        foreach ($socialSettings as $key => $data) {
            Setting::set($key, '', 'socials', $data[2], $data[0], $data[1]);
        }

        // Portal Settings
        $portalSettings = [
            'student_portal' => ['Student Portal Link', 'portals', 'url'],
            'staff_portal' => ['Staff Portal Link', 'portals', 'url'],
            'webmail_portal' => ['Webmail Portal Link', 'portals', 'url'],
        ];

        foreach ($portalSettings as $key => $data) {
            Setting::set($key, '', 'portals', $data[2], $data[0], $data[1]);
        }

        // Donation Settings
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

        // Contact Info Settings
        $contactSettings = [
            'email' => ['General Contact Email', 'contact', 'email'],
            'phone' => ['Main Phone Number', 'contact', 'text'],
            'address' => ['Physical Location Address', 'contact', 'textarea'],
            'postal_address' => ['PO Box', 'contact', 'text'],
            'google_map' => ['Google Maps Location URL', 'contact', 'url'],
            'office_hours' => ['Office Hours (e.g., Mon–Fri: 8am–5pm)', 'contact', 'text'],
        ];

        foreach ($contactSettings as $key => $data) {
            Setting::set($key, '', 'contact', $data[2], $data[0], $data[1]);
        }

        // Email Notification Settings
        $emailSettings = [
            'contact_form_email' => ['Contact Form Email', 'email_notifications', 'email'],
            'newsletter_email' => ['Newsletter Email', 'email_notifications', 'email'],
            'volunteer_email' => ['Volunteer Email', 'email_notifications', 'email'],
            'donation_email' => ['Donation Email', 'email_notifications', 'email'],
            'enroll_email' => ['Enroll Email', 'email_notifications', 'email'],
        ];

        foreach ($emailSettings as $key => $data) {
            Setting::set($key, '', 'email_notifications', $data[2], $data[0], $data[1]);
        }

        // Main Menu Images
        $menuImageSettings = [
            'main_menu_logo_1' => ['Menu Image 1', 'menu_images', 'file'],
            'main_menu_logo_2' => ['Menu Image 2', 'menu_images', 'file'],
            'footer_logo' => ['Footer Logo', 'menu_images', 'file'],
        ];

        foreach ($menuImageSettings as $key => $data) {
            Setting::set($key, '', 'menu_images', $data[2], $data[0], $data[1]);
        }

        // Anniversary Settings
        $anniversarySettings = [
            'years_of_anniversary' => ['Years of Anniversary', 'anniversary', 'number'],
        ];

        foreach ($anniversarySettings as $key => $data) {
            Setting::set($key, '', 'anniversary', $data[2], $data[0], $data[1]);
        }

        // Footer Settings
        $footerSettings = [
            'footer_about' => ['Footer About Text', 'footer', 'textarea'],
        ];

        foreach ($footerSettings as $key => $data) {
            Setting::set($key, '', 'footer', $data[2], $data[0], $data[1]);
        }

        // Quick Links Settings
        $quickLinksSettings = [
            'link_1' => ['Link 1', 'quick_links', 'text'],
            'link_1_url' => ['Link 1 URL', 'quick_links', 'url'],
            'link_2' => ['Link 2', 'quick_links', 'text'],
            'link_2_url' => ['Link 2 URL', 'quick_links', 'url'],
            'link_3' => ['Link 3', 'quick_links', 'text'],
            'link_3_url' => ['Link 3 URL', 'quick_links', 'url'],
            'link_4' => ['Link 4', 'quick_links', 'text'],
            'link_4_url' => ['Link 4 URL', 'quick_links', 'url'],
            'link_5' => ['Link 5', 'quick_links', 'text'],
            'link_5_url' => ['Link 5 URL', 'quick_links', 'url'],
            'link_6' => ['Link 6', 'quick_links', 'text'],
            'link_6_url' => ['Link 6 URL', 'quick_links', 'url'],
            'link_7' => ['Link 7', 'quick_links', 'text'],
            'link_7_url' => ['Link 7 URL', 'quick_links', 'url'],
        ];

        foreach ($quickLinksSettings as $key => $data) {
            Setting::set($key, '', 'quick_links', $data[2], $data[0], $data[1]);
        }

        // Resource Links Settings
        $resourceLinksSettings = [
            'resource_link_1' => ['Link 1', 'resource_links', 'text'],
            'resource_link_1_url' => ['Link 1 URL', 'resource_links', 'url'],
            'resource_link_2' => ['Link 2', 'resource_links', 'text'],
            'resource_link_2_url' => ['Link 2 URL', 'resource_links', 'url'],
            'resource_link_3' => ['Link 3', 'resource_links', 'text'],
            'resource_link_3_url' => ['Link 3 URL', 'resource_links', 'url'],
            'resource_link_4' => ['Link 4', 'resource_links', 'text'],
            'resource_link_4_url' => ['Link 4 URL', 'resource_links', 'url'],
            'resource_link_5' => ['Link 5', 'resource_links', 'text'],
            'resource_link_5_url' => ['Link 5 URL', 'resource_links', 'url'],
            'resource_link_6' => ['Link 6', 'resource_links', 'text'],
            'resource_link_6_url' => ['Link 6 URL', 'resource_links', 'url'],
            'resource_link_7' => ['Link 7', 'resource_links', 'text'],
            'resource_link_7_url' => ['Link 7 URL', 'resource_links', 'url'],
        ];

        foreach ($resourceLinksSettings as $key => $data) {
            Setting::set($key, '', 'resource_links', $data[2], $data[0], $data[1]);
        }

        // Student Application Period Settings
        Setting::set('student_application_open', '0', 'applications', 'boolean', 'Is Student Application Open?', 'Toggle left to close and right to open applications.');
        Setting::set('student_application_note', '', 'applications', 'textarea', 'Application Note', 'Note to display when applications are open.');
        Setting::set('student_application_deadline', '', 'applications', 'text', 'Application Deadline', 'Deadline for student applications.');
    }
}
