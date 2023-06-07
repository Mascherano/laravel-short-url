<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',      [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',    [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',   [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/generate-code',       [ShortUrlController::class, 'generateCode'])->name('shorturl.generate');
    Route::post('/get-url',             [ShortUrlController::class, 'getUrl'])->name('shorturl.get');
    Route::delete('{ShortUrl}/delete',  [ShortUrlController::class, 'deleteUrl'])->name('shorturl.delete');
});

Route::get('/{shortUrl}', [ShortUrlController::class, 'redirectToUrl'])->name('shorturl.redirecttourl');

require __DIR__.'/auth.php';
