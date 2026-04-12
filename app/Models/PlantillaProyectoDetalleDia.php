<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaProyectoDetalleDia extends Model
{
    use HasFactory;

    protected $table = 'plantilla_proyecto_detalle_dias';

    protected $fillable = [
        'plantilla_proyecto_detalle_id',
        'dia_semana',
        'fecha',
        'nombre_dia',
        'horas_normales',
        'horas_extra',
        'proyecto_id',
        'numero_proyecto',
        'es_descanso',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
        'horas_normales' => 'decimal:2',
        'horas_extra' => 'decimal:2',
        'es_descanso' => 'boolean',
    ];

    public function detalle()
    {
        return $this->belongsTo(PlantillaProyectoDetalle::class, 'plantilla_proyecto_detalle_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
