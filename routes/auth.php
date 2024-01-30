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
use App\Http\Controllers\BookController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/{lang}')->middleware(['guest', 'locale'])->group(function () {
    Route::view('/books', 'book')->name('books');
    Route::post('/payment/zaincash/check', [PaymentController::class, 'checkPaymentStatus']);

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

});

Route::prefix('/{lang}')->middleware(['auth', 'locale'])->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');
    Route::post('/member/book/favorite/{id}', [BookController::class, 'addToFavorites'])->name('user.favorite');
    Route::post('/member/book/favorite/{id}/remove', [BookController::class, 'removeFromFavorites'])->name('user.favorite.remove');

    Route::get('profile/books', [BookController::class, 'listAllFavouriteBooks'])->name('user.books');
    Route::get('/member/books', [BookController::class, 'allBooks'])->name('user.allbooks');
    Route::get('/member/book/{id}', [BookController::class, 'showBook'])->name('user.showbook');
    Route::get('/member/book/file/{id}', [BookController::class, 'getBook'])->name('user.getbook');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/payment/zaincash/init', [PaymentController::class, 'createTransactionID'])->name('zain.payment');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/file/{book}', [BookController::class, 'getBook'])
        ->name('user.getbook');

});
