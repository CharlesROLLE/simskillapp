<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/approaches', [App\Http\Controllers\ApproachController::class, 'index'])->name('approaches.index');
Route::get('/approaches/{approach}', [App\Http\Controllers\ApproachController::class, 'show'])->name('approaches.show');
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/vr-tools', [App\Http\Controllers\VrtoolController::class, 'index'])->name('vrtools.index');
Route::get('/vr-tools/{vrtool}', [App\Http\Controllers\VrtoolController::class, 'show'])->name('vrtools.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('about', 'about')->name('about');

require __DIR__.'/settings.php';
require __DIR__.'/admin.php';
