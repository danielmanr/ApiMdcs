<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/medicamentos', function () {
    return 'lista medicamentos';
});

Route::get('/medicamentos/{id}', function () {
    return 'obtiene un medicamento';
});


Route::post('/medicamentos', function () {
    return 'Creando Medicamento';
});


Route::put('/medicamentos/{id}', function () {
    return 'Actualizando Medicamento';
});


Route::delete('/medicamentos/{id}', function () {
    return 'Actualizando Medicamento';
});
