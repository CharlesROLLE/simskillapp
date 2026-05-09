<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with(['user', 'category', 'tags'])->latest('published_at')->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'body' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = asset('storage/'.$path);
        }

        $data['user_id'] = auth()->id();

        $post = Post::create($data);

        if (! empty($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('success', __('Post created.'));
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post->load('tags');

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = asset('storage/'.$path);
        }

        $post->update($data);

        $post->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.posts.index')->with('success', __('Post updated.'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', __('Post deleted.'));
    }
}
