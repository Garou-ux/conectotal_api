<?php

namespace App\Customs\Services\CotizacionProveedores;

use App\Customs\Services\Proyectos\ProyectosService;
use App\Models\CotizacionProveedor;
use App\Models\CotizacionProveedorDetalle;

class CotizacionProveedoresService {

    public function getDataGridParams($data){
        $columns = array(
            array(
                'dataField' => "id",
                'caption' => "# Cotizacion"
            ),
            array(
                'dataField' => "requisicion_id",
                'caption' => "# Requisicion"
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
                'caption' => "Subtotal"
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
                'caption' => "Estatus",
            ),
        );

        return $columns;
    }

    public function getGridData($params){
        $data = array(
            'dateStart' => $params['dateStart'],
            'dateEnd' => $params['dateEnd']
        );
        return CotizacionProveedor::ofDataGrid($params)->get();
    }

    public function getData($cotizacionProveedorId){
        return [
            'data' => CotizacionProveedor::getDataControl($cotizacionProveedorId)
        ];
    }

    public function setData($data){
        $cotizacionProveedor = CotizacionProveedor::updateOrCreate([
            'id' => $data['id']
        ], $data);

        if($data['detalle']){
            foreach ($data['detalle'] as $value) {
                $value['cotizacion_proveedor_id'] = $cotizacionProveedor->id;
                CotizacionProveedorDetalle::updateOrCreate([
                    'id' => $value['id']
                ], $value);
            }
        }

        return $cotizacionProveedor;
    }

    public function convertCotizacionToProyecto($data){
        $proyectoService = new ProyectosService();
        $params = [
            'id' => 0,
            'cotizacion_proveedor_id' => $data['id'],
            'proveedor_id' => $data['proveedor_id'],
            'estatus_id' => 17,
            'fecha' => $data['fecha'],
            'observaciones' => $data['observaciones'],
            'detalles' => $data['detalles']
        ];
        $proyectoService->setData($params);
    }

    public function deleteData($cotizacionProveedorId, $activo){
        $cotizacionProveedor =  CotizacionProveedor::where('id', $cotizacionProveedorId)->update([
            'activo' => $activo
        ]);

        CotizacionProveedorDetalle::where('cotizacion_proveedor_id', $cotizacionProveedorId)->update([
            'activo' => $activo
        ]);

        return $cotizacionProveedor;
    }

}
