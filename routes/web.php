<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationPriceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
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

Route::get('/', [FrontendController::class, 'home'])->name('front.home');
Route::get('/get-destinations/{pickupId}', [FrontendController::class, 'getDestinations'])->name('get.destinations');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/registration', [LoginController::class, 'showRegistrationForm'])->name('registration');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Backend Routes*/
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    //Role Permission Routes
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/location', LocationController::class);
    Route::resource('/location-price', LocationPriceController::class);
    Route::resource('/booking', BookingController::class);
    Route::get('/trip-status/{id}/{statusId}', [BookingController::class, 'tripStatus'])->name('booking.tripStatus');
    Route::get('/where-to-locations/{id}', [BookingController::class, 'whereToLocation']);
    Route::get('/where-to-price/{whereToId}/{PickupPointId}', [BookingController::class, 'whereToPrice']);
    Route::post('/bill-pay/{bookingId}', [BookingController::class, 'billPay'])->name('booking.bill.pay');
    Route::get('/driver-list', [UserController::class, 'driverList'])->name('driver.list');
    Route::get('/passenger-list', [UserController::class, 'passengerList'])->name('passenger.list');
    Route::get('/payment-list', [BookingController::class, 'paymentList'])->name('payment.list');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
});
