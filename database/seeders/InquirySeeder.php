<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use App\Models\Client;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing clients
        $clients = Client::all();
        
        // If no clients exist, create some
        if ($clients->count() < 10) {
            $clients = Client::factory(10)->create();
        }
        
        // Create 5 inquiries for each of the first 10 clients (total 50)
        foreach ($clients->take(10) as $client) {
            Inquiry::factory(5)->create([
                'client_id' => $client->id,
            ]);
        }
        
        $this->command->info('Created 50 inquiries successfully!');
    }
}