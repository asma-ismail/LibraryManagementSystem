<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/{lang}/admin')->middleware('locale')->name('admin.')->group(function () {

    Route::middleware('isAdmin')->group(function () {
        Route::resource('books', BookController::class);
        Route::view('index', 'admin.index')->name('index');
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');
        Route::post('genre', [GenreController::class, 'store'])->name('genre.create');

        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout.post');

    });

    Route::middleware('guest:admin')->group(function () {
        Route::view('login', 'admin.login')->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])
            ->name('login.post');

    });
});
