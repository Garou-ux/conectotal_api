<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $primaryKey = 'id';

    protected $fillable =[
        'cotizacion_proveedor_id',
        'proveedor_id',
        'estatus_id',
        'fecha',
        'subtotal',
        'iva',
        'total',
        'observaciones',
        'activo',
        'empresa_id',
        'user_id',

    ];

    public static function scopeOfDataGrid($query, $params){
        return $query->selectRaw("
            proyectos.id,
            proyectos.cotizacion_proveedor_id,
            proyectos.fecha,
            proyectos.observaciones,
            proyectos.subtotal,
            proyectos.iva,
            proyectos.total,
            proveedores.razon_social,
            estatus.descripcion as estatus
        ")->join('proveedores', function($join){
            $join->on('proveedores.id', 'proyectos.proveedor_id');
        })->join('estatus', function($join){
            $join->on('estatus.id', 'proyectos.estatus_id');
        })->whereBetween(
            'fecha', [$params['dateStart'], $params['dateEnd']]
        );
    }

    public static function getDataControl($id){
        $data = array('data' => [], 'detalles' => []);
        $data['productos'] = Producto::where('activo', 1)->get();
        $data['proveedores'] = Proveedor::OfActivo(1)->get();
        if($id > 0){
            $data['data'] = self::find($id);
            $data['detalles'] = ProyectoDetalle::ofCotizacionProveedorId($id)->ofBorradoLogico(0)->get();
        }

        return $data;
    }
}
