<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'laboratorios';

    // Definir la llave primaria
    protected $primaryKey = 'Id_Laboratorio';

    // Indicar que la llave primaria es un entero autoincremental
    protected $keyType = 'int';
    public $incrementing = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'NombreLaboratorio',
    ];

    // Definir la relación con el modelo Medicamento
    public function medicamento()
    {
        return $this->hasMany(Medicamento::class, 'Id_Laboratorio', 'Id_Laboratorio');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
