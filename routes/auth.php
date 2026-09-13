<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// ============================================
// GUEST ROUTES - Only Login
// ============================================
Route::middleware('guest')->group(function () {
    // Only login route - custom login page
    Volt::route('login', 'pages.auth.login')
        ->name('login');

    // Redirect all other auth routes to login
    Route::get('register', fn() => redirect()->route('login'))->name('register');
    Route::post('register', fn() => redirect()->route('login'));
    
    Route::get('forgot-password', fn() => redirect()->route('login'))->name('password.request');
    Route::post('forgot-password', fn() => redirect()->route('login'))->name('password.email');
    
    Route::get('reset-password/{token}', fn() => redirect()->route('login'))->name('password.reset');
    Route::post('reset-password', fn() => redirect()->route('login'))->name('password.update');
});

// ============================================
// AUTHENTICATED ROUTES
// ============================================
Route::middleware('auth')->group(function () {
    // Disable verify email
    Route::get('verify-email', fn() => redirect()->route('admin.dashboard'))->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // Disable confirm password
    Route::get('confirm-password', fn() => redirect()->route('admin.dashboard'))->name('password.confirm');
    Route::post('confirm-password', fn() => redirect()->route('admin.dashboard'));
});