<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionProveedorDetalle extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones_proveedores_detalles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cotizacion_proveedor_id',
        'producto_id',
        'descripcion',
        'valor_unitario',
        'importe',
        'descuento',
        'iva',
        'total',
        'activo'
    ];

    public function scopeOfCotizacionProveedorId($query,$cotizacionProveedorId){
        return $query->selectRaw("
            cotizaciones_proveedores_detalles.*,
            productos.clave
        ")->join('productos', function($join){
            $join->on('productos.id', 'cotizaciones_proveedores_detalles.producto_id');
        });
    }

    public function scopeOfActivo($query, $activo){
        return $query->where(
            'cotizaciones_proveedores_detalles.activo', $activo
        );
    }
}
