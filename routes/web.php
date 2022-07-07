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
    Route::get('dashboard',  [HomeController::class ,'index'])->name('dashboard');

    //Incapacidad
    Route::resource('incapacidad', IncapacidadController::class);
    Route::resource('incapacidades', IncapacidadesController::class);
    
    //Compania
    Route::resource('compania',CompaniaController::class);

    //Co
    Route::resource('co',CoController::class);

    // Users
    Route::resource('usuario', UserController::class);

});


Route::get('empleados', function () {
    return view('empleados.empleado');
})->name('empleados');
