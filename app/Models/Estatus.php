<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    use HasFactory;

    protected $table = 'estatus';

    protected $fillable = [
        'descripcion',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('estatus.activo', $activo);
    }

    public function scopeOfDescripcion($query, $descripcion){
        return $query->where('estatus.descripcion', $descripcion);
    }
}
