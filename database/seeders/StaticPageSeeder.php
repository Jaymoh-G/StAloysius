<?php

namespace Database\Seeders;

use App\Models\StaticPage;
use Illuminate\Database\Seeder;

class StaticPageSeeder extends Seeder
{
    public function run(): void
    {
        // Create Contact Us page with sections
        StaticPage::create([
            'page_name' => 'Contact Us',
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'content' => '<p>Main contact content</p>',
            'meta_title' => 'Contact Us - St. Aloysius',
            'meta_description' => 'Get in touch with St. Aloysius',
            'section_1_title' => 'Get In Touch',
            'section_1_content' => '<p>This is the first section content with contact information.</p>',
            'section_2_title' => 'Office Hours',
            'section_2_content' => '<p>Monday to Friday: 8:00 AM - 4:00 PM</p>',
            'section_3_title' => 'Location',
            'section_3_content' => '<p>Our school is located at 123 Main Street.</p>',
        ]);

        // Create About Us page with sections
        StaticPage::create([
            'page_name' => 'About Us',
            'title' => 'About St. Aloysius',
            'slug' => 'about-us',
            'content' => '<p>Main about content</p>',
            'meta_title' => 'About Us - St. Aloysius',
            'meta_description' => 'Learn about St. Aloysius',
            'section_1_title' => 'Our History',
            'section_1_content' => '<p>Founded in 1950, St. Aloysius has a rich history.</p>',
            'section_2_title' => 'Our Mission',
            'section_2_content' => '<p>To provide quality education to all students.</p>',
        ]);
    }
}
