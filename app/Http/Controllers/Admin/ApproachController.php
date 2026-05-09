<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approach;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApproachController extends Controller
{
    public function index(): View
    {
        $approaches = Approach::latest()->paginate(20);

        return view('admin.approaches.index', compact('approaches'));
    }

    public function create(): View
    {
        return view('admin.approaches.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'icao' => ['required', 'string', 'max:4'],
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'extract' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = asset('storage/'.$path);
        }

        $data['user_id'] = auth()->id();

        Approach::create($data);

        return redirect()->route('admin.approaches.index')->with('success', __('Approach created.'));
    }

    public function edit(Approach $approach): View
    {
        $approach->load('charts');

        return view('admin.approaches.edit', compact('approach'));
    }

    public function update(Request $request, Approach $approach): RedirectResponse
    {
        $data = $request->validate([
            'icao' => ['required', 'string', 'max:4'],
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'extract' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = asset('storage/'.$path);
        }

        $approach->update($data);

        return redirect()->route('admin.approaches.index')->with('success', __('Approach updated.'));
    }

    public function destroy(Approach $approach): RedirectResponse
    {
        $approach->delete();

        return redirect()->route('admin.approaches.index')->with('success', __('Approach deleted.'));
    }
}
