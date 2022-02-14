<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\{
    HomeController,
    HonorariosController
};

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

Route::get('/', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'iniciarSesion'])->name('iniciarSesion');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//Página de inicio una vez logueado
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Honorarios
Route::group(['prefix' => 'honorarios'], function() {
    Route::get('/calcular-honorario', [HonorariosController::class, 'calcular_honorario'])->name('honorarios.calcular');
    Route::get('/imprimir-presupuesto/{presupuesto}', [HonorariosController::class, 'imprimir_presupusto'])->name('honorarios.presupuesto');
    Route::get('/presupuestos', [HonorariosController::class, 'presupuestos'])->name('honorarios.presupuestos');
});