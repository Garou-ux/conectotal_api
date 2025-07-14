<?php

namespace App\Customs\Services\Plantilla;

use App\Models\Plantilla;

class PlantillaService{

    public function setData($data){
        $plantilla = Plantilla::updateOrCreate([
            'id' => $data['id']
        ], $data);

        return $plantilla;
    }

    public function getGridData(){
        return Plantilla::ofActivo(1)->get();
    }

    public function getData($id){
        return [
            'data' => Plantilla::find($id),
        ];
    }

    public function deleteData(Plantilla $plantilla, $data){
        $plantilla->update([
            'activo' => $data['activo']
        ]);

        return $plantilla;
    }

}
