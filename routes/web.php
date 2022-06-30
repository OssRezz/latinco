<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    //Incapacidad
    Route::resource('incapacidad', IncapacidadController::class);
    Route::resource('incapacidades', IncapacidadesController::class);
});

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('usuarios', function () {
    return view('usuarios.usuarios');
})->name('usuarios');


Route::get('empleados', function () {
    return view('empleados.empleado');
})->name('empleados');
