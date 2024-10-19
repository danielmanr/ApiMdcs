<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use App\Models\TipoMedicamento;
use Illuminate\Http\Request;

class TipoMedicamentosController extends Controller
{
    public function store(Request $request)
    {

        // Validación de datos
        $request->validate([
            'TipoMedicamento' => 'required|string|max:50',
            'ContraIndicacion' => 'required|string|max:50',
        ]);

        // Crear el laboratorio
        $medicamento = TipoMedicamento::create([
            'TipoMedicamento' => $request->TipoMedicamento,
            'ContraIndicacion' => $request->ContraIndicacion
        ]);

        return response()->json($medicamento, 201);
    }
}
