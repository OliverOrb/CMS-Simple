<?php

use App\Models\Post;
use App\Models\Page;
use App\Models\Comment;
use App\Models\User;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware(['auth'])->group(function () {

    // UPDATED DASHBOARD ROUTE
    Route::get('/dashboard', function () {
        $stats = [
            'posts' => Post::count(),
            'pages' => Page::count(),
            'comments' => Comment::count(),
            'users' => User::count(),
        ];

        // Grab the 5 newest posts for a quick activity feed
        $recentPosts = Post::with('user')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentPosts'), ['title' => 'Dashboard']);
    })->name('dashboard');

    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware(['permission:edit content'])->group(function () {
        Route::resource('pages', PageController::class)->except(['index', 'show']);
    });

    Route::resource('pages', PageController::class)->only(['index', 'show']);

    Route::middleware([])->group(function () {
        Route::resource('posts', PostController::class);
        Route::resource('comments', CommentController::class);
    });
});

require __DIR__ . '/auth.php';
