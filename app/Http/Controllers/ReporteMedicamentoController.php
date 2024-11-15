<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteMedicamento;
use Exception;

class ReporteMedicamentoController extends Controller
{
    /**
     * Crear un nuevo reporte de medicamento.
     */
    public function store(Request $request)
    {
        try {
            // Validación de los datos recibidos
            $request->validate([
                'descripcion' => 'required|string|max:255',
                'imagen' => 'required|string', // Se espera una cadena de texto con la URL o base64 de la imagen
                'fechaReporte' => 'required|date',
                'U_Uid' => 'required|string|max:255',
            ]);

            // Crear el nuevo reporte de medicamento
            $reporte = ReporteMedicamento::create([
                'descripcion' => $request->descripcion,
                'imagen' => $request->imagen,
                'fechaReporte' => $request->fechaReporte,
                'U_Uid' => $request->U_Uid,
            ]);

            // Responder con el reporte creado
            return response()->json($reporte, 201);

        } catch (Exception $e) {
            // Manejo de errores
            return response()->json([
                'message' => 'Error al crear el reporte de medicamento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Consultar el reporte de medicamento por U_Uid.
     */
    public function show($U_Uid)
    {
        try {
            // Buscar el último reporte por U_Uid, ordenado por 'id' o por la fecha de creación
            $reporte = ReporteMedicamento::where('U_Uid', $U_Uid)
                ->orderBy('id', 'desc')  // O si prefieres 'created_at' o un campo de fecha
                ->first();

            // Verificar si el reporte existe
            if (!$reporte) {
                return response()->json(['message' => 'Reporte no encontrado'], 404);
            }

            // Responder con el reporte encontrado
            return response()->json($reporte);

        } catch (Exception $e) {
            // Manejo de errores
            return response()->json([
                'message' => 'Error al obtener el reporte',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
