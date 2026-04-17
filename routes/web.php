<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', [PageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('posts', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('posts.store');

// Route friends
// Route::post('friends/{user}', [FriendController::class, 'store'])->middleware(['auth', 'verified'])->name('friends.store');
// Route::put('friends/{user}', [FriendController::class, 'update'])->middleware(['auth', 'verified'])->name('friends.update');

// Route to See profile
//Route::get('profile/{user}', [PageController::class, 'profile'])->middleware(['auth', 'verified'])->name('profile.show');

// Route Status
//Route::get('status', [PageController::class, 'status'])->middleware(['auth', 'verified'])->name('status.show');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
