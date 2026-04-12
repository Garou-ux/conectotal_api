<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoSemana extends Model
{
    use HasFactory;

    protected $table = 'catalogo_semanas';

    protected $fillable = [
        'anio',
        'mes',
        'semana',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activo' => 'boolean',
    ];
}
