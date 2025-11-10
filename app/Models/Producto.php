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

    public function scopeSearch($query, $texto = null)
    {
        return $query->when($texto, function ($q) use ($texto) {
            // Si hay texto, busca por clave o descripción
            $q->where(function ($sub) use ($texto) {
                $sub->where('descripcion', 'like', "%{$texto}%")
                    ->orWhere('clave', 'like', "%{$texto}%")
                    ->orWhere('clave_sat', 'like', "%{$texto}%");
            });
        });
    }

    public static function setProducto($param){
        $prodExists = self::where('descripcion',$param)->first();

        if($prodExists == null){
            self::create([
                'clave' => $param['descripcion'],
                'descripcion' => $param['descripcion'],
                'clave_sat' => ''
            ]);
        }

    }

}
