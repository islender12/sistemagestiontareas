<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ProyectoController;

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


Route::middleware(['auth'])->group(function () {
    Route::resource('/tareas', TareaController::class);
    Route::resource('/proyectos', ProyectoController::class);
    Route::view('home', 'Admin.home')->name('home');

    Route::controller(TareaController::class)->group(fn () => [
        Route::get('listado_tareas', 'listar_tareas')->name('lista_tareas'),
        Route::post('asignar_tarea_usuario', 'AsignarTareaUsuario')->name('asigned.tarea.user'),
    ]);

    Route::get('listado_usuarios', [UserController::class, 'users']);
    Route::controller(ProyectoController::class)->group(fn () => [
        Route::get('projects', 'projects')->name('proyectos.projects'),
    ]);
});
