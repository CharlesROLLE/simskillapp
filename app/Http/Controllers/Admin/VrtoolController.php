<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Vrtool;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VrtoolController extends Controller
{
    public function index(): View
    {
        $vrtools = Vrtool::with(['user', 'category', 'tags'])->latest('published_at')->paginate(20);

        return view('admin.vrtools.index', compact('vrtools'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.vrtools.create', compact('categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'body' => ['required', 'string'],
            'image' => ['required', 'string', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $data['user_id'] = auth()->id();

        $vrtool = Vrtool::create($data);

        if (! empty($data['tags'])) {
            $vrtool->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.vrtools.index')->with('success', __('VR Tool created.'));
    }

    public function edit(Vrtool $vrtool): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        $vrtool->load('tags');

        return view('admin.vrtools.edit', compact('vrtool', 'categories', 'tags'));
    }

    public function update(Request $request, Vrtool $vrtool): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'body' => ['required', 'string'],
            'image' => ['required', 'string', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $vrtool->update($data);

        $vrtool->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.vrtools.index')->with('success', __('VR Tool updated.'));
    }

    public function destroy(Vrtool $vrtool): RedirectResponse
    {
        $vrtool->delete();

        return redirect()->route('admin.vrtools.index')->with('success', __('VR Tool deleted.'));
    }
}
