<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/**
 * Web Routes
 *
 * Here is where you can register web routes for your application.
 * These routes are loaded by the RouteServiceProvider within a group which
 * contains the "web" middleware group. Now create something great!
 */

// Public Routes
Route::get('/', function () {
    return view('welcome', [
        'navItems' => [
            'Home' => route('home'),
            'Blog' => route('blog.index'),
            'Login' => route('login'),
            'Register' => route('register'),
        ],
    ]);
})->name('home');

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {

    // Display All Articles
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // View a Single Article
    Route::get('/{article}', [AdminController::class, 'show'])->name('show');

    // Comments on Articles
    Route::prefix('/{article}/comments')->name('comments.')->group(function () {
        Route::post('/', [CommentController::class, 'store'])->name('store');
        Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('edit');
        Route::patch('/{comment}', [CommentController::class, 'update'])->name('update');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

    Route::get('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


// Admin Routes (Requires Authentication)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard'); // Ensure there's a `resources/views/dashboard.blade.php` file.
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Article Management
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::get('/{article}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::patch('/{article}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{article}', [AdminController::class, 'destroy'])->name('destroy');
    });

    Route::get('/blog', function () {
        return view('blog');
    })->name('blog');    

});

// Authentication Routes
require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
