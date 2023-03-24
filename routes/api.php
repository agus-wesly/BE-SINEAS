<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\FilmController;
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
        Route::get('login-social-callback', 'handleProviderCallback');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
    });

Route::middleware('auth:sanctum')->group(function () {
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
            Route::get('film/{slug}', 'show');
        });
});
