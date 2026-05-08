<?php

use App\Http\Controllers\Admin\ApproachController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VrtoolController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class)->middleware('can:manage-users');

    Route::resource('approaches', ApproachController::class);

    Route::resource('posts', PostController::class);

    Route::resource('vrtools', VrtoolController::class);

    Route::post('uploads/image', [UploadController::class, 'image'])->name('uploads.image');

    Route::get('pages/{slug}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('pages/{slug}', [PageController::class, 'update'])->name('pages.update');
});
