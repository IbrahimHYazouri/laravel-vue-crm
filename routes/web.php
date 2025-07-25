<?php

declare(strict_types=1);

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::permanentRedirect('/', '/login');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('terms', [TermsController::class, 'index'])->name('terms.index');
    Route::post('terms', [TermsController::class, 'store'])->name('terms.store');

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::put('/{notification}', [NotificationController::class, 'update'])->name('update');
        Route::delete('/', [NotificationController::class, 'destroy'])->name('destroy');
    });

    Route::get('/media/{media}/download', [MediaController::class, 'download'])->name('media.download');
});

Route::middleware(['auth', 'can:manage users'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::resource('clients', ClientController::class)->middleware('auth');

Route::resource('projects', ProjectController::class)->middleware('auth');

Route::resource('tasks', TaskController::class)->middleware('auth');

require __DIR__.'/auth.php';
