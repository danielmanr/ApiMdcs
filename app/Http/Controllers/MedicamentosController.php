<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    public function index()
    {
        // Incluye relaciones para la respuesta
        $medicamentos = Medicamento::with(['laboratorios', 'tipoMedicamento', 'historial'])->get();
        return response()->json($medicamentos);
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Concentracion' => 'required|string|max:255',
            'CodigoBarras' => 'required|string|max:255',
            'tipoMedicamento.TipoMedicamento' => 'required|string|max:255',
            'tipoMedicamento.ContraIndicacion' => 'required|string|max:255',
            'laboratorios.*.Nombre' => 'required|string|max:255',
            'historial.*.FechaConsulta' => 'required|date',
            'historial.*.u_id' => 'required|string', // Validación para el u_id
        ]);

        // Crear el medicamento
        $medicamento = Medicamento::create($request->only(['Nombre', 'Concentracion', 'CodigoBarras']));

        // Guardar el tipo de medicamento
        $medicamento->tipoMedicamento()->create($request->tipoMedicamento);

        // Guardar los laboratorios
        foreach ($request->laboratorios as $laboratorioData) {
            $medicamento->laboratorios()->create($laboratorioData);
        }

        // Guardar el historial
        foreach ($request->historial as $historialData) {
            // Se asume que el historialData contiene la fechaConsulta y el u_id
            $historial = Historial::create([
                'FechaConsulta' => $historialData['FechaConsulta'],
                'u_id' => $historialData['u_id'], // Asegúrate de que esto esté en el request
            ]);

            // Asociar el historial con el medicamento
            $medicamento->historial()->attach($historial->Id_Historial, [
                'fechaConsulta' => $historialData['FechaConsulta'] // Asegúrate de que el nombre sea correcto
            ]);
        }

        return response()->json($medicamento->load(['laboratorios', 'tipoMedicamento', 'historial']), 201);
    }

    public function show($id)
    {
        // Incluye relaciones al mostrar
        $medicamento = Medicamento::with(['laboratorios', 'tipoMedicamento', 'historial'])->findOrFail($id);
        return response()->json($medicamento);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'Nombre' => 'sometimes|required|string|max:255',
            'Concentracion' => 'sometimes|required|string|max:255',
            'CodigoBarras' => 'sometimes|required|string|max:255',
            'tipoMedicamento.TipoMedicamento' => 'sometimes|required|string|max:255',
            'tipoMedicamento.ContraIndicacion' => 'sometimes|required|string|max:255',
            'laboratorios.*.Nombre' => 'sometimes|required|string|max:255',
            'historial.*.FechaConsulta' => 'sometimes|required|date',
        ]);

        $medicamento = Medicamento::findOrFail($id);
        $medicamento->update($request->only(['Nombre', 'Concentracion', 'CodigoBarras']));

        // Actualizar tipo de medicamento
        if (isset($request->tipoMedicamento)) {
            $medicamento->tipoMedicamento()->update($request->tipoMedicamento);
        }

        // Actualizar laboratorios
        // Aquí puedes implementar la lógica para actualizar los laboratorios, dependiendo de cómo quieras gestionarlo

        // Actualizar historial
        // Aquí puedes implementar la lógica para actualizar el historial, dependiendo de cómo quieras gestionarlo

        return response()->json($medicamento->load(['laboratorios', 'tipoMedicamento', 'historial']));
    }

    public function destroy($id)
    {
        $medicamento = Medicamento::find($id);
        if (!$medicamento) {
            return response()->json(['message' => 'Medicamento no encontrado'], 404);
        }
        $medicamento->delete();
        return response()->json(['message' => 'Medicamento eliminado correctamente']);
    }

}
