<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\FilmSellingController;
use App\Http\Controllers\FilmSellingPriceController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FilmController;

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

Route::Redirect('/', '/dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit');
        Route::patch('/user/{id}', 'update')->name('user.update');
        Route::get('/user/{id}', 'show')->name('user.show');
    });

    Route::resource('roles', RoleController::class);
    Route::resource('movie', FilmController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('taxes', TaxController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('film-selling-price', FilmSellingPriceController::class);
    Route::resource('film-selling', FilmSellingController::class);
});

require __DIR__.'/auth.php';
