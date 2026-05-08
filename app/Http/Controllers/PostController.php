<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags'])
            ->latest('published_at')
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'category', 'tags']);

        return view('posts.show', compact('post'));
    }
}
