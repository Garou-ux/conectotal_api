<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoDetalle extends Model
{
    use HasFactory;

    protected $table = 'proyectos_detalles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'proyecto_id',
        'producto_id',
        'descripcion',
        'valor_unitario',
        'importe',
        'descuento',
        'iva',
        'total',
        'borrado_logico'
    ];

    public function scopeOfProyectoId($query, $proyecto_id){
        return $query->selectRaw("
            proyectos_detalles.*,
            productos.clave
        ")->join('productos', function($join){
            $join->on('productos.id', 'proyectos_detalles.producto_id');
        })->where(
            'proyectos_detalles.proyecto_id', $proyecto_id
        );
    }

    public function scopeOfBorradoLogico($query, $borrado_logico){
        return $query->where(
            'proyectos_detalles.borrado_logico', $borrado_logico
        );
    }
}
