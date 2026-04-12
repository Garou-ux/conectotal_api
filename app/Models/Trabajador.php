<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabajador extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trabajadores';

    protected $fillable = [
        'supervisor_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'ficha',
        'rfc',
        'curp',
        'user_id',
        'fecha_contratacion'
    ];

    protected $casts = [
        'fecha_contratacion' => 'date'
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function plantillaProyectoDetalles()
    {
        return $this->hasMany(PlantillaProyectoDetalle::class);
    }
}
