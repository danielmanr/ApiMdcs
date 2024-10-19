<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMedicamento extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'tipo_medicamentos';

    // Definir la llave primaria
    protected $primaryKey = 'Id_TipoMedicamento';

    // Indicar que la llave primaria es un entero autoincremental
    protected $keyType = 'int';
    public $incrementing = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'TipoMedicamento', // Tipo del medicamento
        'ContraIndicacion', // Contraindicaciones
    ];

    // Relación uno a uno con la tabla Medicamentos
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'medicamento_id', 'Id_Medicamento');
    }

}
