<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/{lang}/admin')->middleware('locale')->name('admin.')->group(function () {

    Route::middleware('isAdmin')->group(function () {
        Route::get('/subscriber/all', [SubscriberController::class, 'show_all'])->name('subscribers');
        Route::delete('/subscriber/{id}', [SubscriberController::class, 'remove_subscriber'])->name('subscriber.remove');

        Route::get('/subscriber/send-email', [SubscriberController::class, 'send_email'])->name('subscriber_send_email');
        Route::post('/subscriber/send-email-submit', [SubscriberController::class, 'send_email_submit'])->name('subscriber_send_email_submit');
        Route::get('book/{id}/show', [BookController::class, 'getBookAdmin'])->name('showbook');

        Route::resource('books', BookController::class);
        Route::view('home', 'admin.home')->name('index');
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');
        Route::post('genre', [GenreController::class, 'store'])->name('genre.create');
        // Route::get('/book/{id}/show', [BookController::class, 'showBook'])->name('admin.showbook');

        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout.post');

    });

    Route::middleware('guest:admin')->group(function () {
        Route::view('login', 'admin.login')->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])
            ->name('login.post');

    });
});
