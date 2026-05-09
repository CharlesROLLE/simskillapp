<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approach;
use App\Models\Chart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChartController extends Controller
{
    public function create(Approach $approach): View
    {
        return view('admin.charts.create', compact('approach'));
    }

    public function store(Request $request, Approach $approach): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = asset('storage/'.$path);
        }

        $data['approach_id'] = $approach->id;

        Chart::create($data);

        return redirect()->route('admin.approaches.edit', $approach)
            ->with('success', __('Chart added.'));
    }

    public function edit(Chart $chart): View
    {
        $chart->load('approach');

        return view('admin.charts.edit', compact('chart'));
    }

    public function update(Request $request, Chart $chart): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = asset('storage/'.$path);
        }

        $chart->update($data);

        return redirect()->route('admin.approaches.edit', $chart->approach)
            ->with('success', __('Chart updated.'));
    }

    public function destroy(Chart $chart): RedirectResponse
    {
        $approach = $chart->approach;

        $chart->delete();

        return redirect()->route('admin.approaches.edit', $approach)
            ->with('success', __('Chart deleted.'));
    }
}
