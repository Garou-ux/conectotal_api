<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionProveedor extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones_proveedores';

    protected $primaryKey = 'id';

    protected $fillable = [
        'requisicion_id',
        'proveedor_id',
        'estatus_id',
        'fecha',
        'observaciones',
        'subtotal',
        'iva',
        'total',
        'activo',
        'empresa_id',
        'user_id'
    ];

    public function scopeOfDataGrid($query, $params){
        return $query->selecRaw("
            cotizaciones_proveedores.id,
            cotizaciones_proveedores.requisicion_id,
            cotizaciones_proveedores.fecha,
            cotizaciones_proveedores.observaciones,
            cotizaciones_proveedores.subtotal,
            cotizaciones_proveedores.iva,
            cotizaciones_proveedores.total,
            proveedores.razon_social,
            estatus.descripcion as estatus
        ")->join('proveedores', function($join){
            $join->on('proveedores.id', 'cotizaciones_proveedores.proveedor_id');
        })->join('estatus', function($join){
            $join->on('estatus.id', 'cotizaciones_proveedores.estatus_id');
        })->whereBetween(
            'fecha', $params
        )->where([
            ['cotizaciones_proveedores.activo', 1]
        ])
        ->get();
    }

    public function getDataControl($id){
        $data = array('data' => [], 'detalle' => []);

        if($id > 0){
            $data['data'] = CotizacionProveedor::find($id);
            $data['detalle'] = CotizacionProveedorDetalle::ofCotizacionProveedorId($id)->ofActivo(1)->get();
        }
    }
}
