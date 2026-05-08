<?php

namespace App\Http\Controllers;

use App\Models\Approach;

class ApproachController extends Controller
{
    public function index()
    {
        $approaches = Approach::with('charts')->get();

        return view('approaches.index', compact('approaches'));
    }
}
