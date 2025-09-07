<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;

    protected $table = 'plantillas';

    protected $fillable = [
        'estatus_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'rfc',
        'email',
        'rol_id',
        'cat_area_id',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('plantillas.activo', $activo);
    }

    public function scopeOfSelectData($query){
        return $query->selectRaw("
            plantillas.id,
            CONCAT(plantillas.nombre, ' ', plantillas.apellido_paterno, ' ', plantillas.apellido_materno) as descripcion
        ");
    }

    public function scopeOfGridData($query){
        return $query->selectRaw("
            plantillas.id,
            plantillas.rfc,
            CONCAT(plantillas.nombre, ' ', plantillas.apellido_paterno, ' ', plantillas.apellido_materno) as nombre_completo,
            cat_areas.descripcion as area
        ")->join('roles', function($join){
            $join->on('roles.id', 'plantillas.rol_id');
        })->join('cat_areas', function($join){
            $join->on('cat_areas.id', 'plantillas.cat_area_id');
        });
    }
}
