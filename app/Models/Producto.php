<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'producto_categoria_id',
        'clave',
        'descripcion',
        'clave_sat',
        'es_servicio',
        'precio',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('activo', $activo);
    }
}
