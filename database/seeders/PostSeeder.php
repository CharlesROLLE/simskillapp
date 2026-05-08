<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect();
        foreach (['Flight Simming', 'VR & Hardware', 'Tutorials', 'Reviews', 'News'] as $name) {
            $categories->push(Category::create(['name' => $name]));
        }

        $tags = collect();
        foreach (['MSFS2024', 'MSFS2020', 'X-Plane', 'VR', 'Approach', 'Review', 'Hardware', 'Tutorial'] as $name) {
            $tags->push(Tag::create(['name' => $name]));
        }

        $user = User::where('email', 'super@test.com')->first();

        $posts = Post::factory(9)
            ->recycle($categories)
            ->recycle($user)
            ->create();

        $posts->each(function (Post $post) use ($tags, $user) {
            $post->tags()->attach(
                $tags->random(rand(2, 4))->pluck('id')
            );

            PostComment::factory()
                ->count(2)
                ->create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
        });
    }
}
