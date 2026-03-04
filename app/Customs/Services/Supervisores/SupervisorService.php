<?php

namespace App\Customs\Services\Supervisores;

use App\Models\Supervisor;

class SupervisorService {

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
        $supervisor = Supervisor::updateOrCreate([
            'id' => $data['id']
        ], $data);

        return $supervisor;
    }

    public function getGridData(){
        return Supervisor::get();
    }

    public function getData($supervisor_id) {
        $data = array();
        if( $supervisor_id > 0 ) {
            $data = Supervisor::find($supervisor_id);
        }

        return [
            'data' => $data
        ];
    }

    public function deleteData($supervisor_id){
        return Supervisor::find($supervisor_id)->delete()->fresh();
    }

}
