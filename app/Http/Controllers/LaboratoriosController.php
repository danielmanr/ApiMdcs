<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorio;

class LaboratoriosController extends Controller
{
    public function index()
    {
        try {
            $laboratorios = Laboratorio::all();
            return response()->json($laboratorios);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener los laboratorios', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'NombreLaboratorio' => 'required|string|max:50',
            ]);

            $laboratorio = Laboratorio::create([
                'NombreLaboratorio' => $request->NombreLaboratorio,
            ]);

            return response()->json($laboratorio, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear el laboratorio', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $laboratorio = Laboratorio::find($id);

            if (!$laboratorio) {
                return response()->json(['message' => 'Laboratorio no encontrado'], 404);
            }

            return response()->json($laboratorio);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener el laboratorio', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'NombreLaboratorio' => 'required|string|max:50',
            ]);

            $laboratorio = Laboratorio::find($id);

            if (!$laboratorio) {
                return response()->json(['message' => 'Laboratorio no encontrado'], 404);
            }

            $laboratorio->update([
                'NombreLaboratorio' => $request->NombreLaboratorio,
            ]);

            return response()->json($laboratorio);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al actualizar el laboratorio', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $laboratorio = Laboratorio::find($id);

            if (!$laboratorio) {
                return response()->json(['message' => 'Laboratorio no encontrado'], 404);
            }

            $laboratorio->delete();

            return response()->json(['message' => 'Laboratorio eliminado correctamente']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al eliminar el laboratorio', 'error' => $e->getMessage()], 500);
        }
    }
}
