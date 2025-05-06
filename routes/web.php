<?php

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\CommentController;
use App\Http\Controllers\dashboard\CourseController;
use App\Http\Controllers\dashboard\mainController;
use App\Http\Controllers\dashboard\ReviewController;
use App\Http\Controllers\dashboard\UsersController;
use App\Http\Controllers\dashboard\VideoController;
use App\Http\Controllers\homeController;
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

Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about-us', [homeController::class, 'about'])->name('about.us');
Route::get('/contact-us', [homeController::class, 'contact'])->name('contact.us');
Route::get('/courses/{category}', [homeController::class, 'courses'])->name('courses');
Route::get('/payment', [homeController::class, 'payment'])->name('payment');
Route::group(['middleware' => ['auth', 'check.subscription']], function () {

    Route::get('/course-details/{course}/{video?}', [HomeController::class, 'courseDetails'])->name('course.details');
    Route::post('/video/{video}/comment', [HomeController::class, 'storeComment'])->name('videos.comments.store');
});



Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'check.role:super_admin']], function () {

    Route::get('/', [mainController::class, 'index'])->name('home.dashboard');

    Route::resource('users', UsersController::class)->except(['show']);
    Route::get('users/{user}', [UsersController::class, 'show'])->name('users.show');


    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    Route::resource('courses', CourseController::class)->except(['show']);
    Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');
    Route::delete('courses/{id}/force-delete', [CourseController::class, 'forceDelete'])->name('courses.force-delete');

    Route::resource('videos', VideoController::class);

    Route::resource('reviews', ReviewController::class);
    Route::patch('reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');

    Route::resource('comments', CommentController::class);

});



require __DIR__ . '/auth.php';