<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approach>
 */
class ApproachFactory extends Factory
{
    public function definition(): array
    {
        return [
            'icao' => fake()->unique()->bothify('????'),
            'name' => 'ILS '.fake()->randomElement(['24R', '27L', '26R', '13R', '07R', '34R', '16C', '16R', '12R']),
            'country' => fake()->country(),
            'city' => fake()->city(),
            'extract' => fake()->realText(150),
            'description' => fake()->realText(500),
            'image' => 'https://images.pexels.com/photos/61180/pexels-photo-61180.jpeg?auto=compress&cs=tinysrgb&w=500',
        ];
    }
}
