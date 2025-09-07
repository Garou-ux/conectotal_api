<?php

namespace App\Customs\Services\Plantilla;

use App\Models\CatArea;
use App\Models\Plantilla;

class PlantillaService{

    public function getDataGridParams($data){
        $columns = array(
            array(
                'dataField' => "id",
                'caption' => "# Empleado"
            ),
            array(
                'dataField' => "nombre_completo",
                'caption' => "Nombre"
            ),
            array(
                'dataField' => "rfc",
                'caption' => "RFC"
            ),
            array(
                'dataField' => "area",
                'caption' => "Area"
            )
        );

        return $columns;
    }

    public function setData($data){
        $plantilla = Plantilla::updateOrCreate([
            'id' => $data['id']
        ], $data);

        return $plantilla;
    }

    public function getGridData(){
        return Plantilla::ofGridData()->ofActivo(1)->get();
    }

    public function getData($id){
        return [
            'data' => Plantilla::find($id),
            'cat_areas' => CatArea::ofActivo(1)->get()
        ];
    }

    public function deleteData(Plantilla $plantilla, $data){
        $plantilla->update([
            'activo' => $data['activo']
        ]);

        return $plantilla;
    }

}
