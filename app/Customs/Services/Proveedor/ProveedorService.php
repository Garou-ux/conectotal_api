<?php

namespace App\Customs\Services\Proveedor;

use App\Models\Proveedor;


class ProveedorService {

    public function getDataGridParams($data){
        $columns = array(
            array(
                'dataField' => "id",
                'caption' => "No Proveedor",
            ),
            array(
                'dataField' => "razon_social",
                'caption' => "Razon Social"
            ),
            array(
                'dataField' => "rfc",
                'caption' => "RFC"
            )
        );

        return $columns;
    }

    public function setData($data){
        $proveedor = Proveedor::updateOrCreate([
            'id' => $data['id']
        ], $data);


        return $proveedor;
    }

    public function getGridData(){
        return Proveedor::ofActivo(1)->get();
    }

    public function getData($proveedor_id){
        $data = array();
        if( $proveedor_id > 0 ){
            $data = Proveedor::find($proveedor_id);
        }
        return [
            'data' => $data,
        ];
    }

    public function deleteData($proveedor_id, $activo){
        $proveedor = Proveedor::where('id', $proveedor_id)->update([
            'activo' => $activo
        ]);

        return $proveedor;
    }
}
