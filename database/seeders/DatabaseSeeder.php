<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User (For Dashboard Login)
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin', // 👈 FIXED: Standardized column name to grant admin access
        ]);

        // 2. Create Test User (For Checkout Testing)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'user_type' => 'user', // 👈 FIXED: Ensures regular users are correctly categorized
        ]);

        // 3. Runs your ProductSeeder.php file to fill the menu.
        $this->call(ProductSeeder::class);
    }
}