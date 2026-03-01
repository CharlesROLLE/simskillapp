<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/approaches', [App\Http\Controllers\ApproachController::class, 'index'])->name('approaches.index');
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
