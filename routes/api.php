<?php

use App\Http\Controllers\api\apiAuthController;
use App\Http\Controllers\api\homeController;
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


Route::post('register', [apiAuthController::class, 'register']);
Route::post('login', [apiAuthController::class, 'login']);

Route::get('me', [apiAuthController::class, 'me']);
Route::post('logout', [apiAuthController::class, 'logout']);
Route::put('profile', [apiAuthController::class, 'updateProfile']);
Route::delete('account', [apiAuthController::class, 'deleteAccount']);



Route::group([], function () {

    Route::get('/sliders', [homeController::class, 'getingSliders']);
    Route::get('/notifications', [homeController::class, 'getingNotification']);
});
