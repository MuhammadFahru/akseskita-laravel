<?php

use App\Http\Controllers\Api\AuthController;
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

Route::get('/test', function () {
    return 'Hello World';
});

Route::controller(AuthController::class)->group(function () {
    Route::middleware(['throttle:10,1', 'cors'])->group(function () {
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');
    });

    Route::middleware(['auth:sanctum', 'cors'])->group(function () {
        Route::get('user-info', 'getUserInfo')->name('getUserInfo');
    });
});
