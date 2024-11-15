<?php

use App\Http\Controllers\TipoMedicamentosController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;
use App\http\Controllers\LaboratoriosController;


Route::apiResource('/medicamentos',MedicamentosController::class);
Route::apiResource('/usuarios', UsuarioController::class);
Route::apiResource('/laboratorios', \App\Http\Controllers\LaboratoriosController::class);
Route::apiResource('/tipoMedicamentos',TipoMedicamentosController::class);
Route::apiResource('/Administrador', \App\Http\Controllers\AdministradorController::class);
Route::apiResource("/reportemedicamentos",\App\Http\Controllers\ReporteMedicamentoController::class);


// Ruta adicional para el metodo lectura codigo de barras
Route::post('/medicamentos/leerCodigoBarras', [\App\Http\Controllers\MedicamentosController::class, 'leerCodigoBarras']);

// Ruta adicional para el metodo historiaUsuario
Route::post('/medicamentos/historial', [MedicamentosController::class, 'historiaUsuario']);

//Ruta adicional para el metodo reporteMedicamentos
Route::post('/reportemedicamentos/cargarReporte', [\App\Http\Controllers\ReporteMedicamentoController::class, 'store']);
Route::get('/reportemedicamentos/{U_Uid}', [\App\Http\Controllers\ReporteMedicamentoController::class, 'show']);
