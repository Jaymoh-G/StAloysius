<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Call the role seeder to create roles and permissions
        $this->call([
            RoleSeeder::class,
            SuperAdminSeeder::class,
            SettingsSeeder::class,
        ]);

        // Clear permission cache after seeding
        Artisan::call('permission:cache-reset');

        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->info('✅ Permission cache cleared!');
    }
}
