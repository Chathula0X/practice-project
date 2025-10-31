<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryFactory extends Factory
{
    protected $model = Inquiry::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+3 months');
        $endDate = fake()->dateTimeBetween($startDate, $startDate->format('Y-m-d') . ' +2 weeks');
        
        $destinations = [
            'Bali, Indonesia',
            'Maldives',
            'Paris, France',
            'Tokyo, Japan',
            'Dubai, UAE',
            'New York, USA',
            'London, UK',
            'Rome, Italy',
            'Bangkok, Thailand',
            'Sydney, Australia',
            'Barcelona, Spain',
            'Singapore',
            'Amsterdam, Netherlands',
            'Prague, Czech Republic',
            'Istanbul, Turkey'
        ];

        return [
            'client_id' => Client::factory(),
            'destination' => fake()->randomElement($destinations),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'budget' => fake()->randomFloat(2, 1000, 10000),
            'note' => fake()->optional(0.7)->paragraph(),
        ];
    }
}