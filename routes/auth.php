<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Web\Auth\LoginController::class, 'login'])->name('login.store');

Route::get('login/google', [\App\Http\Controllers\Web\Auth\GoogleAuthController::class, 'redirectToGoogle'])->name('google');
Route::get('login/google/callback', [\App\Http\Controllers\Web\Auth\GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('forgot-password', [\App\Http\Controllers\Web\Auth\ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');

Route::get('register', [\App\Http\Controllers\Web\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [\App\Http\Controllers\Web\Auth\RegisterController::class, 'register'])->name('register.store');

Route::get('verify', [\App\Http\Controllers\Web\Auth\VerifyController::class, 'showVerifyForm'])->name('verify');
Route::post('verify', [\App\Http\Controllers\Web\Auth\VerifyController::class, 'verify'])->name('verify.store');


Route::middleware(['auth'])->group(function () {
    Route::post('logout', [\App\Http\Controllers\Web\Auth\LoginController::class, 'logout'])->name('logout');
});
