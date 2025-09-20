<?php

namespace App\Customs\Services\Proyectos;

use App\Models\Proyecto;
use App\Models\ProyectoDetalle;

class ProyectosService {

    public function getDataGridParams($data){
        $columns = array(
            array(
                'dataField' => "id",
                'caption' => "# Proyecto"
            ),
            array(
                'dataField' => "cotizacion_proveedor_id",
                'caption' => "Folio Proyecto"
            ),
            array(
                'dataField' => "fecha",
                'caption' => "Fecha"
            ),
            array(
                'dataField' => "razon_social",
                'caption' => "Proveedor"
            ),
            array(
                'dataField' => "observaciones",
                'caption' => "Observaciones"
            ),
            array(
                'dataField' => "subtotal",
                'caption' => "SubTotal"
            ),
            array(
                'dataField' => "iva",
                'caption' => "IVA"
            ),
            array(
                'dataField' => "total",
                'caption' => "Total"
            ),
            array(
                'dataField' => "estatus",
                'caption' => "Estatus"
            )
        );

        return $columns;
    }

    public function getGridData($params){
        return Proyecto::ofDataGrid($params)->get();
    }

     public function getData($proyecto_id){
        return [
            'data' => Proyecto::getDataControl($proyecto_id)
        ];
    }

    public function setData($data){
        $proyecto = Proyecto::updateOrCreate([
            'id' => $data['id']
        ], $data);

        if($data['detalle']){
            foreach ($data['detalle'] as $value) {
                $value['proyecto_id'] = $proyecto->id;
                ProyectoDetalle::updateOrCreate([
                    'id' => $value['id']
                ], $value);
            }
        }

        return $proyecto;
    }

    public function deleteData($proyecto_id, $activo){
        $proyecto =  Proyecto::where('id', $proyecto_id)->update([
            'activo' => $activo
        ]);

        ProyectoDetalle::where('proyecto_id', $proyecto_id)->update([
            'activo' => $activo
        ]);

        return $proyecto;
    }

}
