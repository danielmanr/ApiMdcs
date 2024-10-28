<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    // Método para almacenar un nuevo medicamento
    public function store(Request $request)
    {
        try {
            // Validación de datos
            $request->validate([
                'Nombre' => 'required|string|max:100',
                'Concentracion' => 'required|string|max:50',
                'CodigoBarras' => 'required|string|unique:medicamentos,CodigoBarras|max:20',
                'tipoMedicamento_Id' => 'required|exists:tipo_medicamentos,Id_TipoMedicamento',
                'Id_Laboratorio' => 'required|exists:laboratorios,Id_Laboratorio' // Validación del laboratorio
            ]);

            // Crear el medicamento
            $medicamento = Medicamento::create([
                'Nombre' => $request->Nombre,
                'Concentracion' => $request->Concentracion,
                'CodigoBarras' => $request->CodigoBarras,
                'tipoMedicamento_Id' => $request->tipoMedicamento_Id,
                'Id_Laboratorio' => $request->Id_Laboratorio // Usando Id_Laboratorio
            ]);

            return response()->json($medicamento, 201);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación', 'messages' => $e->errors()], 422);
        } catch (Exception $e) {
            Log::error('Error al crear el medicamento: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor', 'message' => 'No se pudo crear el medicamento. Inténtelo de nuevo más tarde.'], 500);
        }
    }

    // Método para obtener todos los medicamentos
    public function index()
    {
        try {
            $medicamentos = Medicamento::with(['laboratorios', 'tipoMedicamento'])->get();

            // Transformar la colección para incluir solo lo necesario
            $medicamentosTransformados = $medicamentos->map(function ($medicamento) {
                return [
                    'Id_Medicamento' => $medicamento->Id_Medicamento,
                    'NombreMedicamento' => $medicamento->Nombre,
                    'Concentracion' => $medicamento->Concentracion,
                    'CodigoBarras' => $medicamento->CodigoBarras,
                    'NombreLaboratorio' => $medicamento->laboratorios ? $medicamento->laboratorios->NombreLaboratorio : 'No asignado',
                    'TipoMedicamento' => $medicamento->tipoMedicamento ? $medicamento->tipoMedicamento->TipoMedicamento : 'No asignado',
                ];
            });

            return response()->json($medicamentosTransformados);
        } catch (Exception $e) {
            Log::error('Error al obtener medicamentos: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Método para obtener un medicamento por ID
    public function show($id)
    {
        try {
            $medicamento = Medicamento::with(['laboratorios', 'tipoMedicamento'])->findOrFail($id);

            return response()->json([
                'Id_Medicamento' => $medicamento->Id_Medicamento,
                'NombreMedicamento' => $medicamento->Nombre,
                'Concentracion' => $medicamento->Concentracion,
                'CodigoBarras' => $medicamento->CodigoBarras,
                'NombreLaboratorio' => $medicamento->laboratorios ? $medicamento->laboratorios->NombreLaboratorio : 'No asignado',
                'TipoMedicamento' => $medicamento->tipoMedicamento ? $medicamento->tipoMedicamento->TipoMedicamento : 'No asignado',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Medicamento no encontrado'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener el medicamento: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Método para actualizar un medicamento
    public function update(Request $request, $id)
    {
        try {
            // Validación de datos
            $request->validate([
                'Nombre' => 'sometimes|required|string|max:100',
                'Concentracion' => 'sometimes|required|string|max:50',
                'CodigoBarras' => 'sometimes|required|string|max:20',
                'tipoMedicamento_Id' => 'sometimes|required|exists:tipo_medicamentos,Id_TipoMedicamento',
                'Id_Laboratorio' => 'sometimes|required|exists:laboratorios,Id_Laboratorio' // Validación del laboratorio
            ]);

            // Buscar el medicamento
            $medicamento = Medicamento::findOrFail($id);

            // Actualizar los campos
            $medicamento->update($request->only(['Nombre', 'Concentracion', 'CodigoBarras', 'tipoMedicamento_Id', 'Id_Laboratorio']));

            return response()->json($medicamento);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Medicamento no encontrado'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación', 'messages' => $e->errors()], 422);
        } catch (Exception $e) {
            Log::error('Error al actualizar el medicamento: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Método para eliminar un medicamento
    public function destroy($id)
    {
        try {
            $medicamento = Medicamento::findOrFail($id);
            $medicamento->delete();

            return response()->json(['message' => 'Medicamento eliminado con exito']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Medicamento no encontrado'], 404);
        } catch (Exception $e) {
            Log::error('Error al eliminar el medicamento: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

}
