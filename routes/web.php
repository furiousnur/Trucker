<?php

use App\Http\Controllers\Auth\LoginController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\FrontendController::class, 'home'])->name('front.home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/registration', [LoginController::class, 'showRegistrationForm'])->name('registration');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Backend Routes*/
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
