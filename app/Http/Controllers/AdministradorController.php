<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{

    public function index()
    {
        try
        {
            $administradores = Administrador::all();
            return response()->json($administradores, 200);
        } catch (\Exception $e)
        {
            return response()->json(['message' => 'Error al obtener los administradores', 'error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'Nombre_Administrador' => 'required|string|max:255',
            'Apellido_Administrador' => 'required|string|max:255',
            'Numero_Documento_Administrador' => 'required|string|unique:administradores|max:20',
            'EsSuperAdmin' => 'required|boolean',
            'Usuario' => 'required|string|unique:administradores|max:255',
            'Contrasena' => 'required|string|min:6',
        ]);

        try {
            $administrador = Administrador::create([
                'Nombre_Administrador' => $request->Nombre_Administrador,
                'Apellido_Administrador' => $request->Apellido_Administrador,
                'Numero_Documento_Administrador' => $request->Numero_Documento_Administrador,
                'EsSuperAdmin' => $request->EsSuperAdmin,
                'Usuario' => $request->Usuario,
                'Contrasena' => Hash::make($request->Contrasena),
            ]);

            return response()->json($administrador, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el administrador', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try
        {
            $administrador = Administrador::findOrFail($id);
            return response()->json($administrador, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Administrador no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el administrador', 'error' => $e->getMessage()], 500);
        }

    }


    public function update(Request $request, string $id)
    {
        try {
            // Validación de los datos
            $request->validate([
                'Nombre_Administrador' => 'required|string|max:255',
                'Apellido_Administrador' => 'required|string|max:255',
                'Numero_Documento_Administrador' => "required|string|unique:administradores,Numero_Documento_Administrador,$id,Id_Administrador",
                'EsSuperAdmin' => 'required|boolean',
                'Usuario' => "required|string|unique:administradores,Usuario,$id,Id_Administrador",
                'Contrasena' => 'required|string|min:8',
            ]);

            // Buscar el administrador y actualizarlo
            $administrador = Administrador::findOrFail($id);
            $administrador->update($request->all());

            return response()->json(['message' => 'Administrador actualizado con exito', 'data' => $administrador], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Administrador no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el administrador', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try
        {
            $administrador = Administrador::findOrFail($id);
            $administrador->delete();
            return response()->json(['message' => 'Administrador eliminado correctamente'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Administrador no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el administrador', 'error' => $e->getMessage()], 500);
        }
    }
}
