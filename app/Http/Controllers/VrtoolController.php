<?php

namespace App\Http\Controllers;

use App\Models\Vrtool;

class VrtoolController extends Controller
{
    public function index()
    {
        $vrtools = Vrtool::with(['user', 'category', 'tags'])
            ->latest('published_at')
            ->get();

        return view('vrtools.index', compact('vrtools'));
    }

    public function show(Vrtool $vrtool)
    {
        $vrtool->load(['user', 'category', 'tags']);

        return view('vrtools.show', compact('vrtool'));
    }
}
