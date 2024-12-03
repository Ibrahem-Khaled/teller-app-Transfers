<?php

use App\Http\Controllers\dashboard\AppNotificationController;
use App\Http\Controllers\dashboard\SliderController;
use App\Http\Controllers\dashboard\TellerTransferController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\DashboardController;
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
    return redirect()->route('home.dashboard');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('home.dashboard');

    Route::resource('users', UserController::class);

    Route::resource('sliders', SliderController::class);

    Route::resource('notifications', AppNotificationController::class);

    Route::resource('teller-transfers', TellerTransferController::class);

});

require __DIR__ . '/auth.php';