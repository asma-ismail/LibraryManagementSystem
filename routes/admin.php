<?php
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('isAdmin')->group(function () {
        Route::view('index', 'admin.index')->name('index');
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout.post');
    });

    Route::middleware('guest:admin')->group(function () {
        Route::view('login', 'admin.login')->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])
            ->name('login.post');

    });
});
