<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'usuarios';

    // Definir la llave primaria
    protected $primaryKey = 'Id_Usuario';

    // Indicar que la llave primaria es un entero autoincremental
    protected $keyType = 'int';

    public $timestamps = false;


    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'U_Uid',
        'Nombre',
        'Apellido',
        'FechaIngreso'
    ];

    // Relación muchos a muchos con medicamentos
    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'medicamentos_usuarios', 'usuario_id', 'medicamento_id')
            ->withPivot('fechaConsulta'); // Si necesitas acceder a fechaConsulta en el pivote
    }
}
