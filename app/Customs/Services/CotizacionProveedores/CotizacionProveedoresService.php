<?php

namespace App\Customs\Services\CotizacionProveedores;

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
                'dataField' => "proveedor",
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
                $values['cotizacion_proveedor_id'] = $cotizacionProveedor->cotizacion_proveedor_id;
                CotizacionProveedorDetalle::updateOrCreate([
                    'id' => $value['id']
                ], $value);
            }
        }

        return $cotizacionProveedor;
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
