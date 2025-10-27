<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call Admin Seeder
        $this->call([
            AdminSeeder::class,
            ItinerarySeeder::class,
            ClientSeeder::class,
            SupplierSeeder::class,
            InquirySeeder::class,
        ]);

        // Create test user account
        User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Test User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Test user account created successfully!');
        $this->command->info('Email: user@gmail.com');
        $this->command->info('Password: password');
    }
}
