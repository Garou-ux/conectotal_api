<?php

namespace App\Customs\Services\Roles;

use App\Models\Rol;

class RolesService {

    public function setData($data){
        $rol = Rol::updateOrCreate([
            'id' => $data['id']
        ], $data);

        return $rol;
    }

    public function getGridData(){
        return Rol::ofActivo(1)->get();
    }

    public function getData($id){
        return [
            'data' => Rol::find($id)
        ];
    }

    public function deleteData($id, $activo){
        $cliente = Rol::where('id', $id)->update([
            'activo' => $activo
        ]);

        return $cliente;
    }

}
