<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantillaProyecto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plantilla_proyectos';

    protected $fillable = [
        'supervisor_id',
        'catalogo_semana_id',
        'proyecto_id',
        'user_id',
        'numero_proyecto',
        'anio',
        'mes',
        'semana',
        'fecha_inicio',
        'fecha_fin',
        'observaciones',
        'activo',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activo' => 'boolean',
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function semanaCatalogo()
    {
        return $this->belongsTo(CatalogoSemana::class, 'catalogo_semana_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function detalles()
    {
        return $this->hasMany(PlantillaProyectoDetalle::class)->orderBy('orden');
    }
}
