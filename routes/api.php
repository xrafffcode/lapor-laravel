<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/forgot-password', [\App\Http\Controllers\Api\Auth\ForgotPasswordController::class, 'forgotPassword'])->name('api.auth.forgot-password');
Route::post('/verify-otp', [\App\Http\Controllers\Api\Auth\ForgotPasswordController::class, 'verifyOtp'])->name('api.auth.verify-otp');
Route::post('/reset-password', [\App\Http\Controllers\Api\Auth\ForgotPasswordController::class, 'resetPassword'])->name('api.auth.reset-password');
