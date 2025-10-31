<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing clients if you want fresh data
        // Client::truncate(); // Uncomment this if you want to clear existing data
        
        // Create 50 clients with realistic data
        Client::factory(50)->create();
        
        $this->command->info('Created 50 clients successfully!');
    }
}