<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use App\Models\TipoMedicamento;
use Illuminate\Http\Request;

class TipoMedicamentosController extends Controller
{
    public function index()
    {
        try {
            $medicamentos = TipoMedicamento::all();
            return response()->json($medicamentos, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener los tipos de medicamento: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => 'No se pudieron obtener los tipos de medicamento. Inténtelo de nuevo más tarde.'
            ], 500);
        }
    }

    // Método para obtener un solo registro por ID
    public function show($id)
    {
        try {
            $medicamento = TipoMedicamento::findOrFail($id);
            return response()->json($medicamento, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tipo de medicamento no encontrado',
                'message' => 'No se encontró un tipo de medicamento con el ID proporcionado.'
            ], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener el tipo de medicamento: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => 'No se pudo obtener el tipo de medicamento. Inténtelo de nuevo más tarde.'
            ], 500);
        }
    }


    public function store(Request $request)
    {

        try {
            // Validación de datos
            $request->validate([
                'TipoMedicamento' => 'required|string|max:50',
                'ContraIndicacion' => 'required|string|max:50',
            ]);

            // Crear el tipo de medicamento
            $medicamento = TipoMedicamento::create([
                'TipoMedicamento' => $request->TipoMedicamento,
                'ContraIndicacion' => $request->ContraIndicacion
            ]);

            return response()->json($medicamento, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Captura errores de validación
            return response()->json([
                'error' => 'Error de validación',
                'messages' => $e->errors()
            ], 422);

        } catch (Exception $e) {
            // Captura cualquier otro tipo de error
            Log::error('Error al crear el tipo de medicamento: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => 'No se pudo crear el tipo de medicamento. Inténtelo de nuevo más tarde.'
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'TipoMedicamento' => 'required|string|max:50',
                'ContraIndicacion' => 'required|string|max:50',
            ]);

            $medicamento = TipoMedicamento::findOrFail($id);
            $medicamento->update([
                'TipoMedicamento' => $request->TipoMedicamento,
                'ContraIndicacion' => $request->ContraIndicacion
            ]);

            return response()->json($medicamento, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Error de validación',
                'messages' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tipo de medicamento no encontrado',
                'message' => 'No se encontró un tipo de medicamento con el ID proporcionado.'
            ], 404);
        } catch (Exception $e) {
            Log::error('Error al actualizar el tipo de medicamento: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => 'No se pudo actualizar el tipo de medicamento. Inténtelo de nuevo más tarde.'
            ], 500);
        }
    }

    // Método para eliminar un registro
    public function destroy($id)
    {
        try {
            $medicamento = TipoMedicamento::findOrFail($id);
            $medicamento->delete();

            return response()->json([
                'message' => 'Tipo de medicamento eliminado correctamente'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tipo de medicamento no encontrado',
                'message' => 'No se encontró un tipo de medicamento con el ID proporcionado.'
            ], 404);
        } catch (Exception $e) {
            Log::error('Error al eliminar el tipo de medicamento: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => 'No se pudo eliminar el tipo de medicamento. Inténtelo de nuevo más tarde.'
            ], 500);
        }
    }
}
