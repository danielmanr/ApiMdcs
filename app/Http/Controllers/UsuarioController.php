<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{


    //devuelven todos los usuarios
    public function index(){
        $usuarios = Usuario::all();
        return response()->json($usuarios,200);
    }


    //metodo para buscar un usuario en especifico
    public function show($id){
        $usuarios = Usuario::findOrfail($id);
        return response()->json($usuarios,200);
    }

    //metodo para guardar los usuarios
    public function store(Request $request){
        $request->validate([
            'U_Uid' => 'string|required',
            'Nombre' => 'string|required|max:50',
            'Apellido' => 'string|required|max:50',
            'FechaIngreso' => 'date|required'
        ]);

        try
        {
            $usuario = Usuario::create([
               'U_Uid' => $request->U_Uid,
                'Nombre' => $request->Nombre,
                'Apellido' => $request->Apellido,
                'FechaIngreso' => $request->FechaIngreso
            ],201);

            return response()->json($usuario,201);

        } catch (\Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            return response()->json([
                'message' => 'Error al crear el medicamento.',
                'error' => $e->getMessage() // Mensaje de error para depuración
            ], 500); // Código de estado 500 para error interno del servidor
        }
    }

    //metodo para la actualizacion usuarios
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'U_Uid' => 'string|required',
            'Nombre' => 'string|required|max:50',
            'Apellido' => 'string|required|max:50',
            'FechaIngreso' => 'date|required'
        ]);

        try {
            // Buscar el usuario por ID
            $usuario = Usuario::findOrFail($id); // Cambia Usuario por el nombre de tu modelo

            // Actualizar los datos del usuario
            $usuario->U_Uid = $request->U_Uid;
            $usuario->Nombre = $request->Nombre;
            $usuario->Apellido = $request->Apellido;
            $usuario->FechaIngreso = $request->FechaIngreso;

            $usuario->save(); // Guardar los cambios

            return response()->json($usuario, 200); // Devolver el usuario actualizado
        } catch (\Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar el usuario.',
                'error' => $e->getMessage() // Mensaje de error para depuración
            ], 500); // Código de estado 500 para error interno del servidor
        }
    }


    //metodo para eliminar los usuarios
    public function destroy($id)
    {
        try {
            // Buscar el usuario por ID
            $usuario = Usuario::findOrFail($id); // Cambia Usuario por el nombre de tu modelo

            $usuario->delete(); // Eliminar el usuario

            return response()->json([
                'message' => 'Usuario eliminado exitosamente.'
            ], 200); // Devolver un mensaje de éxito
        } catch (\Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            return response()->json([
                'message' => 'Error al eliminar el usuario.',
                'error' => $e->getMessage() // Mensaje de error para depuración
            ], 500); // Código de estado 500 para error interno del servidor
        }
    }
}
