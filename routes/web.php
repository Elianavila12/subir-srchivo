<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
    return view('index');
});

// -------------------- Usuario ----------------------

Route::get('/usuario', [UserController::class, 'index'])->name('usuario.index');

Route::get('/usuario/crear', [UserController::class, 'create'])->name('usuario.crear');

Route::post('/usuario/crear', [UserController::class, 'store'])->name('usuario.guardar');

Route::post('/usuario/cargar', [UserController::class, 'importCSV'])->name('usuario.cargar');

Route::get('/usuario/csv/{id}', [UserController::class, 'exportCSV'])->name('usuario.csv');

Route::get('/usuario/editar/{user}', [UserController::class, 'edit'])->name('usuario.editar');

Route::put('/usuario/editar/{user}', [UserController::class, 'update'])->name('usuario.actualizar');

Route::delete('/usuario/eliminar/{user}', [UserController::class, 'destroy'])->name('usuario.eliminar');
