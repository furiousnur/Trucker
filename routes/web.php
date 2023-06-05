<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationPriceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\FrontendController::class, 'home'])->name('front.home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/registration', [LoginController::class, 'showRegistrationForm'])->name('registration');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Backend Routes*/
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    //Role Permission Routes
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/location', LocationController::class);
    Route::resource('/location-price', LocationPriceController::class);
    Route::resource('/booking', BookingController::class);
    Route::get('/where-to-locations/{id}', [BookingController::class, 'whereToLocation']);
    Route::get('/where-to-price/{whereToId}/{PickupPointId}', [BookingController::class, 'whereToPrice']);
});
