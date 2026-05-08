<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function edit(string $slug): View
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'image' => ['required', 'string', 'max:2048'],
        ]);

        $page->update($data);

        return redirect()->route('admin.pages.edit', $page->slug)->with('success', __('Page updated.'));
    }
}
