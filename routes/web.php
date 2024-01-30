<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Models\Book;
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

Route::get('/', function () {

})->middleware('locale');
Route::prefix('/{lang}')->middleware('locale')->group(function () {
    Route::post('/subscriber', [SubscriberController::class, 'index'])->name('subscribe');
    Route::get('/subscriber/verify/{token}/{email}', [SubscriberController::class, 'verify'])->name('subscriber_verify');

    Route::view('/pricing', 'pricing')->name('pricing');
    Route::view('/contact', 'contactus')->name('contactus');

    Route::get('/', function () {
        $books = Book::latest()->take(3)->get();
        return view('welcome', compact('books'));
    })->name('home');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified', 'locale'])->name('dashboard');

    Route::middleware(['auth', 'locale'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
