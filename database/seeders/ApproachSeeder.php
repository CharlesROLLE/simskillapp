<?php

namespace Database\Seeders;

use App\Models\Approach;
use App\Models\Chart;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApproachSeeder extends Seeder
{
    public function run(): void
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

        $user = User::where('email', 'super@test.com')->first();

        foreach ($airports as $airport) {
            $approach = Approach::factory()
                ->has(Chart::factory()->count(3), 'charts')
                ->create($airport);

            Comment::factory()
                ->count(2)
                ->create([
                    'approach_id' => $approach->id,
                    'user_id' => $user->id,
                ]);
        }
    }
}
