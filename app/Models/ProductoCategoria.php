<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;

    protected $table = 'productos_categorias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('productos_categorias.activo', $activo);
    }
}
