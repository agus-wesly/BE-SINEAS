<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\TransactionController;
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

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::get('login-social', 'redirectToProvider');
        Route::post('login-google', 'loginWithGoogle');
        Route::get('login-social-callback', 'loginWithGoogle');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
        Route::put('users/{id}', 'updateUser')->middleware('auth:sanctum');
        Route::post('users/link-forget', 'sendLinkForgetPassword')->middleware('auth:sanctum');
        Route::post('users/forget', 'forgetPassword');
        Route::post('users/reset-password', 'resetPassword');
        Route::get('users', 'currentUser')->middleware('auth:sanctum');
    });

Route::controller(BannerController::class)
    ->group(function () {
        Route::get('banners', 'index');
        Route::get('banners/{id}', 'show');
    });

Route::controller(FilmController::class)
    ->group(function () {
        Route::get('film-populer', 'filmPopuler');
        Route::get('film-terbaru', 'filmTerbaru');
        Route::get('film-coming-soon', 'filmComingSoon');
        Route::get('film-related', 'filmRelated')->middleware('auth:sanctum');
        Route::get('film-being-watched', 'filmBeingWatched')->middleware('auth:sanctum');
        Route::get('film-watched', 'filmWatched')->middleware('auth:sanctum');
        Route::get('film/{slug}', 'show');
        Route::get('search', 'search');
        Route::get('genres/{slug}', 'listFilmByGenre');
        Route::post('wishlist/{filmId}', 'whislistStore')->middleware('auth:sanctum');
        Route::get('wishlist', 'whislistList')->middleware('auth:sanctum');
        Route::get('tax' , 'getTax');
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(TransactionController::class)
        ->group(function () {
            Route::get('transaction-success', 'transactionSuccess');
            Route::post('order', 'createOrder');
        });
});

Route::post('midtrans-callback', [TransactionController::class, 'callbackMidtrans']);

Route::get('genres', GenreController::class);

