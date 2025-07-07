<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found. Please create users first.');
            return;
        }

        $activities = [
            // Login activities
            ['action' => 'login', 'module' => 'auth', 'description' => 'User logged in'],
            ['action' => 'logout', 'module' => 'auth', 'description' => 'User logged out'],

            // Blog activities
            ['action' => 'create', 'module' => 'blog', 'description' => 'Created news post: Welcome to St. Aloysius College'],
            ['action' => 'update', 'module' => 'blog', 'description' => 'Updated news post: Annual Sports Day Announcement'],
            ['action' => 'create', 'module' => 'blog', 'description' => 'Created news post: New Academic Programs Available'],
            ['action' => 'delete', 'module' => 'blog', 'description' => 'Deleted news post: Old Announcement'],

            // Event activities
            ['action' => 'create', 'module' => 'events', 'description' => 'Created event: Annual Sports Meet 2024'],
            ['action' => 'update', 'module' => 'events', 'description' => 'Updated event: Science Fair Schedule'],
            ['action' => 'create', 'module' => 'events', 'description' => 'Created event: Parent-Teacher Meeting'],
            ['action' => 'publish', 'module' => 'events', 'description' => 'Published event: Cultural Festival'],

            // Gallery activities
            ['action' => 'upload', 'module' => 'gallery', 'description' => 'Uploaded 15 images to Sports Album'],
            ['action' => 'create', 'module' => 'gallery', 'description' => 'Created album: Campus Life 2024'],
            ['action' => 'update', 'module' => 'gallery', 'description' => 'Updated album: Graduation Ceremony'],

            // YouTube activities
            ['action' => 'create', 'module' => 'youtube', 'description' => 'Added video: Campus Tour 2024'],
            ['action' => 'update', 'module' => 'youtube', 'description' => 'Updated video: Principal\'s Message'],

            // Career activities
            ['action' => 'create', 'module' => 'careers', 'description' => 'Posted job vacancy: Mathematics Teacher'],
            ['action' => 'update', 'module' => 'careers', 'description' => 'Updated job: Science Lab Assistant'],
            ['action' => 'publish', 'module' => 'careers', 'description' => 'Published job: Administrative Assistant'],

            // Testimonial activities
            ['action' => 'create', 'module' => 'testimonials', 'description' => 'Added testimonial from John Doe'],
            ['action' => 'update', 'module' => 'testimonials', 'description' => 'Updated testimonial from Jane Smith'],

            // Department activities
            ['action' => 'create', 'module' => 'departments', 'description' => 'Created department: Computer Science'],
            ['action' => 'update', 'module' => 'departments', 'description' => 'Updated department: Mathematics'],

            // Facility activities
            ['action' => 'create', 'module' => 'facilities', 'description' => 'Added facility: New Computer Lab'],
            ['action' => 'update', 'module' => 'facilities', 'description' => 'Updated facility: Library Information'],

            // Team activities
            ['action' => 'create', 'module' => 'team', 'description' => 'Added team member: Dr. Sarah Johnson'],
            ['action' => 'update', 'module' => 'team', 'description' => 'Updated profile: Prof. Michael Brown'],

            // Static page activities
            ['action' => 'create', 'module' => 'static_pages', 'description' => 'Created page: About Our History'],
            ['action' => 'update', 'module' => 'static_pages', 'description' => 'Updated page: Contact Information'],

            // User management activities
            ['action' => 'create', 'module' => 'users', 'description' => 'Created user account: newteacher@school.com'],
            ['action' => 'update', 'module' => 'users', 'description' => 'Updated user permissions: admin@school.com'],

            // Role activities
            ['action' => 'create', 'module' => 'roles', 'description' => 'Created role: Content Editor'],
            ['action' => 'update', 'module' => 'roles', 'description' => 'Updated role: Teacher permissions'],
        ];

        $now = Carbon::now();

        foreach ($activities as $index => $activityData) {
            // Create activities with different timestamps (spread over the last 30 days)
            $timestamp = $now->copy()->subDays(\rand(0, 30))->subHours(\rand(0, 23))->subMinutes(\rand(0, 59));

            Activity::create([
                'user_id' => $users->random()->id,
                'action' => $activityData['action'],
                'module' => $activityData['module'],
                'description' => $activityData['description'],
                'ip_address' => '192.168.1.' . \rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }

        $this->command->info('Sample activities created successfully!');
    }
}
