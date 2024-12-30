<?php

use App\Http\Controllers\dashboard\AppNotificationController;
use App\Http\Controllers\dashboard\SliderController;
use App\Http\Controllers\dashboard\TellerTransferController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\web\homeController;
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
Route::get('/', [homeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => ['auth', 'isActive']], function () {

    //this main routes 
    Route::get('/certificate', [homeController::class, 'certificate'])->name('certificate');
    Route::get('/full/course', [homeController::class, 'fullCourse'])->name('fullCourse');
    Route::get('/invoice/{invoiceId}', [homeController::class, 'invoice'])->name('invoice');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'check.role:admin']], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('home.dashboard');

    Route::resource('users', UserController::class);
    Route::get('user/updateStatus/{userId}', [UserController::class, 'updateStatus'])->name('user.updateStatus');

    Route::resource('sliders', SliderController::class);

    Route::resource('notifications', AppNotificationController::class);

    Route::resource('teller-transfers', TellerTransferController::class);
});



require __DIR__ . '/auth.php';