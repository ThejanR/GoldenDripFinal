<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForceAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'admin@test.com';
        
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->user_type = 'admin';
            $user->password = Hash::make('password'); // Resetting password to 'password' just in case
            $user->save();
            $this->command->info("User {$email} updated to ADMIN.");
        } else {
            User::create([
                'name' => 'Admin User',
                'email' => $email,
                'password' => Hash::make('password'),
                'user_type' => 'admin',
            ]);
            $this->command->info("User {$email} created as ADMIN.");
        }
    }
}
