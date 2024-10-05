<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;
use App\http\Controllers\HistorialController;
use App\http\Controllers\LaboratoriosController;


Route::apiResource('/medicamentos',medicamentosController::class);
Route::apiResource('/historial', HistorialController::class);
Route::apiResource('/laboratorios', LaboratoriosController::class);
