<?php

namespace App\Customs\Services\Trabajadores;

use App\Models\Supervisor;
use App\Models\Trabajador;

class TrabajadorService {

    public function getDataGridParams($data) {
        $columns = array(
            array(
                'dataField' => "id",
                'caption' => "No. Supervisor"
            ),
            array(
                'dataField' => "nombre",
                'caption' => "Nombre"
            ),
            array(
                'dataField' => "rfc",
                'caption' => "RFC"
            )
        );

        return $columns;
    }

    public function setData($data){
        $trabajador = Trabajador::updateOrCreate([
            'id' => $data['id']
        ], $data);

        return $trabajador;
    }

    public function getGridData(){
        return Trabajador::get();
    }

    public function getData($trabajador_id) {
        $data = array();
        if( $trabajador_id > 0 ) {
            $data = Trabajador::find($trabajador_id);
        }

        return [
            'data' => $data,
            'supervisores' => Supervisor::get()
        ];
    }

    public function deleteData($trabajador_id){
        return Trabajador::find($trabajador_id)->delete()->fresh();
    }


}
