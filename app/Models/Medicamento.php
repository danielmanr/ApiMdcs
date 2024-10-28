<?php

namespace App\Models;

use App\Models\Historial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Medicamento extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla (si es necesario)
    protected $table = 'medicamentos';

    // Especificar la clave primaria si no es "id"
    protected $primaryKey = 'Id_Medicamento';

    // Definir los atributos que pueden ser asignados de manera masiva
    protected $fillable = [
        'Nombre',
        'Concentracion',
        'CodigoBarras',
        'tipoMedicamento_Id',
        'Id_Laboratorio'
    ];

    // Si no usas incrementing id en Laravel (lo que no es tu caso)
    public $incrementing = true;

    // Especificar el tipo de la clave primaria (entero por defecto)
    protected $keyType = 'int';

    // Relación con la tabla laboratorios (uno a muchos)
    public function laboratorios()
    {
        return $this->belongsTo(Laboratorio::class, 'Id_Laboratorio', 'Id_Laboratorio');
    }

    // Relación con la tabla historial (muchos a muchos)
    public function historial()
    {
        return $this->belongsToMany(Historial::class, 'historial_medicamento', 'medicamento_id', 'historial_id')
            ->withPivot('fechaConsulta');
    }


    // Relación con la tabla tipoMedicamentos (uno a uno)
    public function tipoMedicamento()
    {
        return $this->belongsTo(TipoMedicamento::class, 'tipoMedicamento_Id', 'Id_TipoMedicamento');
    }

}
