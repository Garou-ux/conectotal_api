<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaProyectoDetalle extends Model
{
    use HasFactory;

    protected $table = 'plantilla_proyecto_detalles';

    protected $fillable = [
        'plantilla_proyecto_id',
        'trabajador_id',
        'orden',
        'ficha',
        'nombre_trabajador',
        'tn',
        'hes',
        'hdo',
        'hd',
        'ht',
        'bono_puntualidad',
        'observaciones',
    ];

    protected $casts = [
        'tn' => 'decimal:2',
        'hes' => 'decimal:2',
        'hdo' => 'decimal:2',
        'hd' => 'decimal:2',
        'ht' => 'decimal:2',
        'bono_puntualidad' => 'boolean',
    ];

    public function plantillaProyecto()
    {
        return $this->belongsTo(PlantillaProyecto::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function dias()
    {
        return $this->hasMany(PlantillaProyectoDetalleDia::class)->orderBy('dia_semana');
    }
}
