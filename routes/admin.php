<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\Web\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/laporan', [\App\Http\Controllers\Web\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/laporan/{report}', [\App\Http\Controllers\Web\Admin\ReportController::class, 'show'])->name('reports.show');

    Route::post('/laporan/status', [\App\Http\Controllers\Web\Admin\ReportStatusController::class, 'store'])->name('reports.status.store');

    Route::resource('berita', \App\Http\Controllers\Web\Admin\NewsController::class);
    Route::resource('wisata', \App\Http\Controllers\Web\Admin\TourController::class);
    Route::resource('kuliner', \App\Http\Controllers\Web\Admin\CulinaryController::class);
});
