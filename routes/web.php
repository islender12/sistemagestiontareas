<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TareaController;

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
    return view('welcome');
});



Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login.start');
    Route::post('login', 'login')->name('login');
    Route::get('register', 'index')->name('register.start');
    Route::post('register', 'register')->name('register');
    Route::get('logout', 'logout')->name('logout');
});

Route::get('home', function () {
    return view('Admin.home');
})->middleware('auth')->name('home');

Route::resource('/tareas', TareaController::class);
