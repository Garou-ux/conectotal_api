<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    use HasFactory;

    protected $table = 'requisiciones';

    protected $primaryKey = 'id';

    protected $fillable = [
        'empleado_id',
        'cat_area_id',
        'estatus_id',
        'fecha',
        'observaciones',
        'activo',
        'empresa_id',
        'user_id'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where(
            'requisiciones.activo', $activo
        );
    }

    public function scopeOfDataGrid($query, $params){
        return $query->selectRaw("
            requisiciones.id,
            requisiciones.fecha,
            CONCAT(plantillas.nombre, ' ', plantillas.apellido_paterno, ' ', plantillas.apellido_materno) as empleado,
            cat_areas.descripcion as area,
            requisiciones.observaciones,
            estatus.descripcion as estatus
        ")->leftjoin('plantillas', function($join){
            $join->on('plantillas.id', 'requisiciones.empleado_id');
        })->leftjoin('cat_areas', function($join){
            $join->on('cat_areas.id', 'plantillas.cat_area_id');
        })->leftjoin('estatus', function($join){
            $join->on('estatus.id', 'requisiciones.estatus_id');
        })->whereBetween(
            'requisiciones.fecha', [$params['dateStart'], $params['dateEnd']]
        );
    }

    public static function getDataControl($id){
        $data = array('data' => [], 'detalles' => []);
        $data['productos'] = Producto::where('activo', 1)->get();
        $data['empleados'] = Plantilla::OfSelectData()->OfActivo(1)->get();
        if($id > 0){
            $data['data'] = Requisicion::find($id);
            $data['detalles'] = RequisicionDetalle::ofRequisicionId($id)->ofActivo(0)->get();
        }

        return $data;
    }


}
