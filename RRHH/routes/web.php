<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\Tipos\TiposIncidentesController;
use App\Http\Controllers\Tipos\TiposDescansosController;
use App\Http\Controllers\Tipos\TiposEpisController;
use App\Http\Controllers\Tipos\TiposAusenciaController;
use App\Http\Controllers\Tipos\TiposEventosController;
use App\Http\Controllers\Tipos\TiposAvisosController;


use App\Http\Controllers\JornadasController;

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

//Gestion tipos incidentes
Route::get('/TiposIncidentes', [TiposIncidentesController::class, 'index'])->name('TiposIncidentes');
Route::post('/listarTiposIncidentes', [TiposIncidentesController::class, 'listarTiposIncidentes'])->name('listarTiposIncidentes');
Route::post('/getDataTiposIncidentes', [TiposIncidentesController::class, 'getDataTiposIncidentes'])->name('getDataTiposIncidentes');
Route::post('/updateTiposIncidentes', [TiposIncidentesController::class, 'updateTiposIncidentes'])->name('updateTiposIncidentes');
Route::post('/insertTiposIncidentes', [TiposIncidentesController::class, 'insertTiposIncidentes'])->name('insertTiposIncidentes');
Route::post('/activadesactivaTiposIncidentes', [TiposIncidentesController::class, 'activadesactivaTiposIncidentes'])->name('activadesactivaTiposIncidentes');

//Gestion tipos descansos
Route::get('/TiposDescansos', [TiposDescansosController::class, 'index'])->name('TiposDescansos');
Route::post('/listarTiposDescansos', [TiposDescansosController::class, 'listarTiposDescansos'])->name('listarTiposDescansos');
Route::post('/getDataTiposDescansos', [TiposDescansosController::class, 'getDataTiposDescansos'])->name('getDataTiposDescansos');
Route::post('/updateTiposDescansos', [TiposDescansosController::class, 'updateTiposDescansos'])->name('updateTiposDescansos');
Route::post('/insertTiposDescansos', [TiposDescansosController::class, 'insertTiposDescansos'])->name('insertTiposDescansos');
Route::post('/activadesactivaTiposDescansos', [TiposDescansosController::class, 'activadesactivaTiposDescansos'])->name('activadesactivaTiposDescansos');

//jornada
Route::get('/jornada', [JornadasController::class, 'index'])->name('jornada');
Route::post('/iniciarJornada', [JornadasController::class, 'iniciarJornada'])->name('iniciarJornada');
Route::post('/finalizarJornada', [JornadasController::class, 'finalizarJornada'])->name('finalizarJornada');
Route::post('/insertDescansoJornada', [JornadasController::class, 'insertDescansoJornada'])->name('insertDescansoJornada');
Route::post('/finalizarDescanso', [JornadasController::class, 'finalizarDescanso'])->name('finalizarDescanso');

//Gestion tipos epi
Route::get('/TiposEpis', [TiposEpisController::class, 'index'])->name('TiposEpis');
Route::post('/listarTiposEpis', [TiposEpisController::class, 'listarTiposEpis'])->name('listarTiposEpis');
Route::post('/getDataTiposEpis', [TiposEpisController::class, 'getDataTiposEpis'])->name('getDataTiposEpis');
Route::post('/updateTiposEpis', [TiposEpisController::class, 'updateTiposEpis'])->name('updateTiposEpis');
Route::post('/insertTiposEpis', [TiposEpisController::class, 'insertTiposEpis'])->name('insertTiposEpis');
Route::post('/activadesactivaTiposEpis', [TiposEpisController::class, 'activadesactivaTiposEpis'])->name('activadesactivaTiposEpis');


//Gestion tipos ausencia
Route::get('/TiposAusencias', [TiposAusenciaController::class, 'index'])->name('TiposAusencias');
Route::post('/listarTiposAusencias', [TiposAusenciaController::class, 'listarTiposAusencias'])->name('listarTiposAusencias');
Route::post('/getDataTiposAusencias', [TiposAusenciaController::class, 'getDataTiposAusencias'])->name('getDataTiposAusencias');
Route::post('/updateTiposAusencias', [TiposAusenciaController::class, 'updateTiposAusencias'])->name('updateTiposAusencias');
Route::post('/insertTiposAusencias', [TiposAusenciaController::class, 'insertTiposAusencias'])->name('insertTiposAusencias');
Route::post('/activadesactivaTiposAusencias', [TiposAusenciaController::class, 'activadesactivaTiposAusencias'])->name('activadesactivaTiposAusencias');


//Gestion tipos eventos
Route::get('/TiposEventos', [TiposEventosController::class, 'index'])->name('TiposEventos');
Route::post('/listarTiposEventos', [TiposEventosController::class, 'listarTiposEventos'])->name('listarTiposEventos');
Route::post('/getDataTiposEventos', [TiposEventosController::class, 'getDataTiposEventos'])->name('getDataTiposEventos');
Route::post('/updateTiposEventos', [TiposEventosController::class, 'updateTiposEventos'])->name('updateTiposEventos');
Route::post('/insertTiposEventos', [TiposEventosController::class, 'insertTiposEventos'])->name('insertTiposEventos');
Route::post('/activadesactivaTiposEventos', [TiposEventosController::class, 'activadesactivaTiposEventos'])->name('activadesactivaTiposEventos');


//Gestion tipos avisos
Route::get('/TiposAvisos', [TiposAvisosController::class, 'index'])->name('TiposAvisos');
Route::post('/listarTiposAvisos', [TiposAvisosController::class, 'listarTiposAvisos'])->name('listarTiposAvisos');
Route::post('/getDataTiposAvisos', [TiposAvisosController::class, 'getDataTiposAvisos'])->name('getDataTiposAvisos');
Route::post('/updateTiposAvisos', [TiposAvisosController::class, 'updateTiposAvisos'])->name('updateTiposAvisos');
Route::post('/insertTiposAvisos', [TiposAvisosController::class, 'insertTiposAvisos'])->name('insertTiposAvisos');
Route::post('/activadesactivaTiposAvisos', [TiposAvisosController::class, 'activadesactivaTiposAvisos'])->name('activadesactivaTiposAvisos');




//Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin');

