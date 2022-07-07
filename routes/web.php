<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
    return view('auth/login');
})->name('/');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {


    //Dashboard
    Route::get('dashboard',  [HomeController::class, 'index'])->name('dashboard');

    //Incapacidad
    Route::resource('incapacidad', IncapacidadController::class);
    Route::resource('incapacidades', IncapacidadesController::class);
    Route::resource('ReportesIncapacidad', ReporteIncapacidadController::class);

    //Compania
    Route::resource('compania', CompaniaController::class);

    //Co
    Route::resource('co', CoController::class);

    // Users
    Route::resource('usuario', UserController::class);
});


Route::get('empleados', function () {
    return view('empleados.empleado');
})->name('empleados');


Route::get('bancos', function () {
    return view('bancos.banco');
})->name('bancos');

Route::get('proveedores', function () {
    return view('proveedores.proveedor');
})->name('proveedores');

Route::get('conceptocaja', function () {
    return view('conceptocaja.conceptocaja');
})->name('conceptocaja');

Route::get('conceptos', function () {
    return view('conceptos.concepto');
})->name('conceptos');

Route::get('responsables', function () {
    return view('responsables.responsable');
})->name('responsables');


