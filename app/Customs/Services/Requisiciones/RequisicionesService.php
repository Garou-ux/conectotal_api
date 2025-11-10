<?php

namespace App\Customs\Services\Requisiciones;

use App\Customs\Services\FolioService;
use App\Models\Producto;
use App\Models\Requisicion;
use App\Models\RequisicionDetalle;

class RequisicionesService {
     public function getDataGridParams($data){
        $columns = array(
            array(
                'dataField' => "id",
                'caption' => "# Requisicion",
            ),
            array(
                'dataField' => "folio",
                'caption' => "Folio"
            ),
            array(
                'dataField' => "fecha",
                'caption' => "Fecha"
            ),
            array(
                'dataField' => "empleado",
                'caption' => "Solicitante"
            ),
            array(
                'dataField' => "area",
                'caption' => "Area"
            ),
            array(
                'dataField' => "observaciones",
                'caption' => "Observaciones"
            ),
            array(
                'dataField' => "estatus",
                'caption' => "Estatus"
            ),
        );

        return $columns;
    }

    public function getGridData($data){
        $params = array(
            'dateStart' => $data['dateStart'],
            'dateEnd' => $data['dateEnd']
        );
        return Requisicion::ofDataGrid($params)->ofActivo(1)->get();
    }

    public function getData($requisicion_id){
        return [
            'data' => Requisicion::getDataControl($requisicion_id)
        ];
    }

    public function setData($data){
        if($data['id'] <= 0){
            $data['folio'] = FolioService::generarFolio('R');
        }
        $requisicion = Requisicion::updateOrCreate([
            'id' => $data['id']
        ],$data);

        if($data['detalle']){
            foreach ($data['detalle'] as $value) {
                if($data['__confirm']){
                    Producto::setProducto($value);
                }
                $value['requisicion_id'] = $requisicion->id;
                RequisicionDetalle::updateOrCreate([
                    'id' => $value['id']
                ],$value);
            }
        }

        return $requisicion;
    }

    public function deleteData($requisicion_id, $activo){
        $requisicion = Requisicion::where('id', $requisicion_id)->update([
            'activo' => $activo
        ]);

        RequisicionDetalle::where('requisicion_id', $requisicion_id)->update([
            'activo' => $activo
        ]);

        return $requisicion;
    }

    public function getRequisicionesForCotizacion(){
        return RequisicionDetalle::ofReqCoti()->ofActivo(0)->get();
    }
}
