<?php

use App\Http\Controllers\TipoMedicamentosController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;
use App\http\Controllers\LaboratoriosController;


Route::apiResource('/medicamentos',MedicamentosController::class);
Route::apiResource('/usuarios', UsuarioController::class);
Route::apiResource('/laboratorios', LaboratoriosController::class);
Route::apiResource('/tipoMedicamentos',TipoMedicamentosController::class);

// Ruta adicional para el método leerCodigoBarras
Route::post('/medicamentos/leerCodigoBarras', [MedicamentosController::class, 'leerCodigoBarras']);
