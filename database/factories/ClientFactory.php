<?php

namespace Database\Factories;


use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
   protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'nationality' => fake()->country(),
            'preferences' => fake()->sentence(),
        ];
    }
}
