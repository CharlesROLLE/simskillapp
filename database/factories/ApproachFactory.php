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
        $airports = [
            ['icao' => 'KLAX', 'name' => 'ILS 24R', 'country' => 'United States', 'city' => 'Los Angeles'],
            ['icao' => 'EGLL', 'name' => 'ILS 27L', 'country' => 'United Kingdom', 'city' => 'London'],
            ['icao' => 'LFPG', 'name' => 'ILS 26R', 'country' => 'France', 'city' => 'Paris'],
            ['icao' => 'KJFK', 'name' => 'ILS 13R', 'country' => 'United States', 'city' => 'New York'],
            ['icao' => 'EDDF', 'name' => 'ILS 07R', 'country' => 'Germany', 'city' => 'Frankfurt'],
            ['icao' => 'RJTT', 'name' => 'ILS 34R', 'country' => 'Japan', 'city' => 'Tokyo'],
            ['icao' => 'KSEA', 'name' => 'ILS 16C', 'country' => 'United States', 'city' => 'Seattle'],
            ['icao' => 'LIRF', 'name' => 'ILS 16R', 'country' => 'Italy', 'city' => 'Rome'],
            ['icao' => 'OMDB', 'name' => 'ILS 12R', 'country' => 'UAE', 'city' => 'Dubai'],
        ];

        $airport = $this->faker->randomElement($airports);

        return [
            'icao' => $airport['icao'],
            'name' => $airport['name'],
            'country' => $airport['country'],
            'city' => $airport['city'],
            'extract' => fake()->realText(150),
            'description' => fake()->realText(500),
            'image' => 'https://images.pexels.com/photos/61180/pexels-photo-61180.jpeg?auto=compress&cs=tinysrgb&w=500',
        ];
    }
}
