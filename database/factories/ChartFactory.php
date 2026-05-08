<?php

namespace Database\Factories;

use App\Models\Approach;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chart>
 */
class ChartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'approach_id' => Approach::factory(),
            'name' => fake()->randomElement(['ILS Approach', 'NDB Approach', 'VOR Approach', 'Visual Approach', 'RNAV Approach']),
            'image' => 'https://images.pexels.com/photos/1600727/pexels-photo-1600727.jpeg?auto=compress&cs=tinysrgb&w=500',
        ];
    }
}
