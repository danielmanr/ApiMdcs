<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteMedicamento extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'reportemedicamentos'; // Nombre de la tabla

    // Definir la llave primaria
    protected $primaryKey = 'id'; // La llave primaria por defecto es 'id' si no se especifica lo contrario

    // Indicar que la llave primaria es un entero autoincremental
    protected $keyType = 'int';
    public $incrementing = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'descripcion', // Descripción del reporte
        'imagen', // Imagen asociada al reporte
        'fechaReporte', // Fecha del reporte
        'U_Uid',
    ];

    // Ocultar los campos created_at y updated_at si no se desean en las respuestas
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
