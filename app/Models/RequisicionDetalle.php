<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisicionDetalle extends Model
{
    use HasFactory;

    protected $table = 'requisiciones_detalles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'requisicion_id',
        'producto_id',
        'cantidad',
        'cantidad_pendiente',
        'cantidad_comprada',
        'descripcion',
        'observacion',
        'activo',
        'borrado_logico'
    ];

    public function scopeOfRequisicionId($query,$requisicion_id){
        return $query->selectRaw("
            requisiciones_detalles.id,
            requisiciones_detalles.producto_id,
            requisiciones_detalles.requisicion_id,
            requisiciones_detalles.cantidad,
            requisiciones_detalles.descripcion,
            requisiciones_detalles.observacion,
            requisiciones_detalles.borrado_logico,
            productos.clave
        ")->join('productos', function($join){
            $join->on('productos.id', 'requisiciones_detalles.producto_id');
        });
    }

    public function scopeOfActivo($query, $activo){
        return $query->where(
            'requisiciones_detalles.borrado_logico', $activo
        );
    }
}
