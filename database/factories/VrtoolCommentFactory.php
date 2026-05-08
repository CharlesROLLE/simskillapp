<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vrtool;
use Illuminate\Database\Eloquent\Factories\Factory;

class VrtoolCommentFactory extends Factory
{
    /** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VrtoolComment> */
    public function definition(): array
    {
        return [
            'vrtool_id' => Vrtool::factory(),
            'user_id' => User::factory(),
            'body' => fake()->realText(120),
        ];
    }
}
