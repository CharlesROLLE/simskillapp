<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approach;
use App\Models\Post;
use App\Models\User;
use App\Models\Vrtool;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'approaches' => Approach::count(),
            'posts' => Post::count(),
            'vrtools' => Vrtool::count(),
        ];

        return view('admin.dashboard.index', compact('stats'));
    }
}
