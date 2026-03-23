<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['title' => 'Dashboard']);
    })->name('dashboard');

    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware([])->group(function () {
        Route::resource('posts', PostController::class);
        Route::resource('comments', CommentController::class);
        Route::resource('pages', PageController::class);
    });
});

require __DIR__.'/auth.php';
