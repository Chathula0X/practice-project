<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Itinerary;
use App\Models\Inquiry;
use App\Models\Client;

class ItinerarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing clients
        $clients = Client::all();

        // If less than 10 clients exist, create more
        if ($clients->count() < 10) {
            $clients = Client::factory(10)->create();
        }

        // Create inquiries and itineraries for each client
        foreach ($clients->take(10) as $client) {
            // Create 5 inquiries per client
            $inquiries = Inquiry::factory(5)->create([
                'client_id' => $client->id,
            ]);

            // Create 1 itinerary for each inquiry
            foreach ($inquiries as $inquiry) {
                Itinerary::factory()->create([
                    'inquiry_id' => $inquiry->id,
                ]);
            }
        }

        $this->command->info('Created 50 Itineraries successfully!');
    }
}