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
        'user_id',
        'requisiciones'
    ];

    public function scopeOfDataGrid($query, $params){
        return $query->selectRaw("
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
            'fecha', [$params['dateStart'], $params['dateEnd']]
        );
    }

    public static function getDataControl($id){
        $data = array('data' => [], 'detalles' => []);
        $data['productos'] = Producto::where('activo', 1)->get();
        $data['proveedores'] = Proveedor::OfActivo(1)->get();
        if($id > 0){
            $data['data'] = CotizacionProveedor::find($id);
            $data['detalles'] = CotizacionProveedorDetalle::ofCotizacionProveedorId($id)->ofActivo(0)->get();
        }

        return $data;
    }
}
