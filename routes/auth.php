<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');

    Route::get('forgot-password', ForgotPassword::class)
        ->name('password.request');
    Route::get('reset-password/{token}', ResetPassword::class)
        ->name('password.reset');

    Route::get('auth/facebook', FacebookController::class)->name('auth.facebook');
    Route::get('callback/facebook', [FacebookController::class, 'handleCallback'])->name('facebook.callback-handle');

    Route::get('auth/google', GoogleController::class)->name('auth.google');
    Route::get('callback/google', [GoogleController::class, 'handleCallback'])->name('google.callback-handle');
});

Route::middleware('auth')->group(function (): void {
    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::get('confirm-password', ConfirmPassword::class)->name('password.confirm');
});
