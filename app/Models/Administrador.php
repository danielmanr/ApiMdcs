<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;


    // Nombre de la tabla
    protected $table = 'administradores';

    // Clave primaria personalizada
    protected $primaryKey = 'Id_Administrador';

    // Atributos asignables en masa
    protected $fillable = [
        'Nombre_Administrador',
        'Apellido_Administrador',
        'Numero_Documento_Administrador',
        'EsSuperAdmin',
        'Usuario',
        'Contrasena',
    ];

    // Indicar que la clave primaria no es autoincremental
    public $incrementing = true;

    // Especificar el tipo de clave primaria si es necesario
    protected $keyType = 'int';

    // Indicar que el modelo usa las columnas de timestamps
    public $timestamps = true;

    // Ocultar campos sensibles cuando se convierta el modelo a JSON
    protected $hidden = [
        'Contrasena',
    ];
}
