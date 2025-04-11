<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'store'])->name('login.store');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

Route::put('/update-status/{id}', [App\Http\Controllers\UserController::class, 'updateStatus'])->name('updateStatus');


Route::get('/appointment', [App\Http\Controllers\AppointmentController::class, 'index'])->name('appointment');
Route::get('/appointment/create', [App\Http\Controllers\AppointmentController::class, 'create'])->name('appointment.create');
Route::get('/appointment/{id}/edit', [App\Http\Controllers\AppointmentController::class, 'edit'])->name('appointment.edit');
Route::post('/appointment/store', [App\Http\Controllers\AppointmentController::class, 'store'])->name('appointment.store');
Route::put('/appointment/{id}', [App\Http\Controllers\AppointmentController::class, 'update'])->name('appointment.update');
Route::delete('/appointment/{id}', [App\Http\Controllers\AppointmentController::class, 'destroy'])->name('appointment.destroy');

