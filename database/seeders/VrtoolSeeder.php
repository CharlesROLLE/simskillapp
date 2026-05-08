<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vrtool;
use App\Models\VrtoolComment;
use Illuminate\Database\Seeder;

class VrtoolSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect();
        foreach (['Flight Simming', 'VR & Hardware', 'Tutorials', 'Reviews', 'News'] as $name) {
            $categories->push(Category::firstOrCreate(['name' => $name]));
        }

        $tags = collect();
        foreach (['MSFS2024', 'MSFS2020', 'X-Plane', 'VR', 'Approach', 'Review', 'Hardware', 'Tutorial'] as $name) {
            $tags->push(Tag::firstOrCreate(['name' => $name]));
        }

        $user = User::where('email', 'super@test.com')->first();

        $vrtools = Vrtool::factory(8)
            ->recycle($categories)
            ->recycle($user)
            ->create();

        $vrtools->each(function (Vrtool $vrtool) use ($tags, $user) {
            $vrtool->tags()->attach(
                $tags->random(rand(2, 4))->pluck('id')
            );

            VrtoolComment::factory()
                ->count(2)
                ->create([
                    'vrtool_id' => $vrtool->id,
                    'user_id' => $user->id,
                ]);
        });
    }
}
