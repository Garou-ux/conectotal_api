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
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('plantillas.activo', $activo);
    }
}
