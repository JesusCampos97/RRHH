<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
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
    return redirect('usuarios');
});


Auth::routes();

//Gestion usuarios
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios');
Route::post('/listarusuarios', [UsuariosController::class, 'listarusuarios'])->name('listarusuarios');
Route::post('/getDataUsuarios', [UsuariosController::class, 'getDataUsuarios'])->name('getDataUsuarios');
Route::post('/updateUsuario', [UsuariosController::class, 'updateUsuario'])->name('updateUsuario');
Route::post('/insertUsuario', [UsuariosController::class, 'insertUsuario'])->name('insertUsuario');
Route::post('/activadesactivaUsuario', [UsuariosController::class, 'activadesactivaUsuario'])->name('activadesactivaUsuario');


//Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin');

