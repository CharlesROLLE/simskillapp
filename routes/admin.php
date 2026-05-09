<?php

use App\Http\Controllers\Admin\ApproachController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VrtoolController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class)->middleware('can:manage-users');

    Route::resource('approaches', ApproachController::class);

    Route::prefix('approaches/{approach}/charts')->name('approaches.charts.')->group(function () {
        Route::get('create', [ChartController::class, 'create'])->name('create');
        Route::post('', [ChartController::class, 'store'])->name('store');
    });

    Route::prefix('charts')->name('charts.')->group(function () {
        Route::get('{chart}/edit', [ChartController::class, 'edit'])->name('edit');
        Route::put('{chart}', [ChartController::class, 'update'])->name('update');
        Route::delete('{chart}', [ChartController::class, 'destroy'])->name('destroy');
    });

    Route::resource('posts', PostController::class);

    Route::resource('vrtools', VrtoolController::class);

    Route::post('uploads/image', [UploadController::class, 'image'])->name('uploads.image');

    Route::resource('categories', CategoryController::class)->middleware('can:manage-categories');

    Route::resource('tags', TagController::class)->middleware('can:manage-categories');

    Route::get('pages/{slug}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('pages/{slug}', [PageController::class, 'update'])->name('pages.update');
});
