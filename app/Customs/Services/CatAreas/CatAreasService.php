<?php

namespace App\Customs\Services\CatAreas;

use App\Models\CatArea;

class CatAreasService {

    public function getDataGridParams($data){
        $columns = array(
            array(
                'dataField' => "id",
                'caption' => "# Area"
            ),
            array(
                'dataField' => "descripcion",
                'caption' => "Descripcion"
            )
        );

        return $columns;
    }

    public function getGridData($params){
        return CatArea::ofDataGrid()->ofActivo(1)->get();
    }

    public function getData($catAreaId){
        return [
            'data' => CatArea::find($catAreaId)
        ];
    }

    public function setData($data){
        $catArea = CatArea::updateOrCreate([
            'id' => $data['id']
        ], $data);

        return $catArea;
    }

    public function deleteData(int $catAreaId, int $activo){
        $catArea = CatArea::where('id')->update([
            'activo',  $activo
        ]);

        return $catArea;
    }
}
