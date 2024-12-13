<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/**
 * Blogging Website Routes
 *
 * This file defines the routes for a blogging website, including authentication,
 * admin article management, and user comments.
 */

// Guest Routes (Unauthenticated Users)
Route::middleware('guest')->group(function () {

    // Registration Routes
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login Routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Password Reset Routes
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Email Verification Routes
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Password Confirmation Routes
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Password Update Route
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout Route
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Admin Article Management Routes
    Route::prefix('admin/articles')->name('admin.articles.')->middleware('auth')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('index'); // List all articles
        Route::get('/create', [ArticleController::class, 'create'])->name('create'); // Create article form
        Route::post('/', [ArticleController::class, 'store'])->name('store'); // Store new article
        Route::get('/{article}', [ArticleController::class, 'show'])->name('show'); // View single article
        Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit'); // Edit article form
        Route::patch('/{article}', [ArticleController::class, 'update'])->name('update'); // Update article
        Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy'); // Delete article
    });

    // Comment Management Routes
    Route::prefix('articles/{article}/comments')->name('comments.')->group(function () {
        Route::post('/', [CommentController::class, 'store'])->name('store'); // Post a new comment
        Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('edit'); // Edit comment form
        Route::patch('/{comment}', [CommentController::class, 'update'])->name('update'); // Update comment
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy'); // Delete comment
    });

});

// Public Article Viewing Routes
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'publicIndex'])->name('index'); // List all articles
    Route::get('/{article}', [ArticleController::class, 'publicShow'])->name('show'); // View single article
});


