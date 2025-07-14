<?php

namespace App\Customs\Services\Cliente;

use App\Models\Cliente;
use App\Models\ClienteDireccion;

class ClienteService {

    public function getDataGridParams($data){
        $columns = array(
            array(
                'dataField' => "id",
                'caption' => "No Cliente",
            ),
            array(
                'dataField' => "razon_social",
                'caption' => "Razon Social"
            )
        );

        return $columns;
    }

    public function setData($data){
        $cliente = Cliente::updateOrCreate([
            'id' => $data['id']
        ], $data);

        if( isset($data['direcciones']) ){
            foreach ($data['direcciones'] as $value) {
                $value['cliente_id'] = $cliente->id;
                ClienteDireccion::updateOrCreate([
                    'id' => $value['id']
                ], $value);
            }
        }
        return $cliente;
    }

    public function getGridData(){
        return Cliente::ofActivo(1)->get();
    }

    public function getData($cliente_id){
        $data = array();
        if( $cliente_id > 0 ){
            $data = Cliente::find($cliente_id);
        }
        return [
            'data' => $data,
            'cliente_direcciones' => ClienteDireccion::ofClienteId($cliente_id)->get()
        ];
    }

    public function deleteData($cliente_id, $activo){
        $cliente = Cliente::where('id', $cliente_id)->update([
            'activo' => $activo
        ]);

        return $cliente;
    }
}
