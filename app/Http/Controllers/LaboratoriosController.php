<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorio;

class LaboratoriosController extends Controller
{
    public function store(Request $request)
    {

        // Validación de datos
        $request->validate([
            'NombreLaboratorio' => 'required|string|max:50',
        ]);

        // Crear el laboratorio
        $laboratorio = Laboratorio::create([
            'NombreLaboratorio' => $request->NombreLaboratorio,
        ]);

        return response()->json($laboratorio, 201);
    }
}
