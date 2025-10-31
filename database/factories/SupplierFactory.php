<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        // Only use the types defined in the migration ENUM
        $supplierTypes = [
            'Hotel',
            'Transport',
            'Tour Company'
        ];

        $locations = [
            'Bali, Indonesia',
            'Paris, France',
            'Tokyo, Japan',
            'New York, USA',
            'Dubai, UAE',
            'London, UK',
            'Rome, Italy',
            'Barcelona, Spain',
            'Bangkok, Thailand',
            'Sydney, Australia',
            'Singapore',
            'Amsterdam, Netherlands',
            'Prague, Czech Republic',
            'Istanbul, Turkey',
            'Maldives'
        ];

        return [
            'name' => fake()->company() . ' ' . fake()->randomElement(['Services', 'Group', 'International', 'Travel', 'Hotels', 'Tours']),
            'type' => fake()->randomElement($supplierTypes),
            'email' => fake()->unique()->companyEmail(),
            'location' => fake()->randomElement($locations),
            'notes' => fake()->optional(0.7)->paragraph(),
        ];
    }
}