<?php

namespace Database\Seeders;

use App\Models\Approach;
use App\Models\Chart;
use Illuminate\Database\Seeder;

class ApproachSeeder extends Seeder
{
    public function run(): void
    {
        Approach::factory(9)
            ->has(Chart::factory()->count(3), 'charts')
            ->create();
    }
}
