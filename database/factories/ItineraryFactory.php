<?php

namespace Database\Factories;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Itinerary>
 */
class ItineraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $start_date = fake()->dateTimeBetween('now', '+3 months');
       $end_date = fake()->dateTimeBetween($start_date, $start_date->format('Y-m-d') . ' +2 weeks');
       
       $destinations = ['Bali', 'Maldives', 'Paris', 'Tokyo', 'Dubai', 'New York', 'London', 'Rome', 'Bangkok', 'Sydney'];
       $hotels = ['Grand Hyatt', 'Hilton', 'Marriott', 'Four Seasons', 'Sheraton', 'Ritz-Carlton', 'InterContinental'];
       $roomTypes = ['standard', 'deluxe', 'suite', 'villa'];
       $transportTypes = ['flight', 'car_rental', 'train', 'private_transfer', 'bus'];

       $activities = [
        ['name' => 'Scuba Diving', 'cost' => fake()->randomFloat(2, 50, 300)],
        ['name' => 'City Tour', 'cost' => fake()->randomFloat(2, 30, 150)],
        ['name' => 'Museum Visit', 'cost' => fake()->randomFloat(2, 20, 80)],
        ['name' => 'Boat Ride', 'cost' => fake()->randomFloat(2, 40, 200)],
        ['name' => 'Hiking', 'cost' => fake()->randomFloat(2, 25, 100)],
    ];

    $nights = fake()->numberBetween(1,10);
    $costPerNight = fake()->randomFloat(2, 100, 500);
    $accommodationTotal = $nights * $costPerNight;

    $transportCost = fake()->randomFloat(2, 200, 1000);

    $selectedActivities = fake()->randomElements($activities, fake()->numberBetween(2, 4));
    $activitiesTotal = array_sum(array_column($selectedActivities, 'cost'));

    $destination = fake()->randomElement($destinations);

    return [
        'inquiry_id' => Inquiry::factory(),
        'title' => $destination . ' ' . fake()->randomElement(['Trip', 'Journey', 'Vacation', 'Escape']),
        'destination' => $destination,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'accommodation' => [
            'hotel_name' => fake()->randomElement($hotels),
            'room_type' => fake()->randomElement($roomTypes),
            'nights' => $nights,
            'cost_per_night' => $costPerNight,
        ],
        'transport' => [
            'type' => fake()->randomElement($transportTypes),
            'from' => fake()->city(),
            'to' => $destination,
            'cost' => $transportCost,
        ],
        'activities'=> $selectedActivities,
        'accommodation_total' => $accommodationTotal,
        'transport_total' => $transportCost,
        'activities_total' => $activitiesTotal,
        'total_cost' => $accommodationTotal + $transportCost + $activitiesTotal,
        'notes' => fake()->sentence(),
        'status' => fake()->randomElement(['draft','pending', 'approved', 'rejected']),
    ];
    
    }
}
