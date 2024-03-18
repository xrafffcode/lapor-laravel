<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\Web\App\HomeController::class, 'index'])->name('home');

Route::get('/laporan', [\App\Http\Controllers\Web\App\ReportController::class, 'index'])->name('report.index');
Route::get('/laporan/{id}', [\App\Http\Controllers\Web\App\ReportController::class, 'show'])->name('report.show');

Route::get('/notifikasi', [\App\Http\Controllers\Web\App\NotificationController::class, 'index'])->name('notification.index');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/lapor', [\App\Http\Controllers\Web\App\ReportController::class, 'take'])->name('report.take');
    Route::get('/lapor/preview', [\App\Http\Controllers\Web\App\ReportController::class, 'preview'])->name('report.preview');
    Route::get('/lapor/create', [\App\Http\Controllers\Web\App\ReportController::class, 'create'])->name('report.create');
    Route::post('/lapor', [\App\Http\Controllers\Web\App\ReportController::class, 'store'])->name('report.store');
    Route::get('/laporan-sukses', [\App\Http\Controllers\Web\App\ReportController::class, 'success'])->name('report.success');

    Route::get('/laporan-saya', [\App\Http\Controllers\Web\App\ReportController::class, 'myReport'])->name('report.my-report');
});
