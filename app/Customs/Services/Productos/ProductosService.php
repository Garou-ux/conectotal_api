<?php

namespace App\Customs\Services\Productos;

use App\Models\Producto;

class ProductosService {

    public function setData($data){
        $producto = Producto::updateOrCreate([
            'id' => $data['id']
        ], $data);

        return $producto;
    }

    public function getGridData(){
        return Producto::ofActivo(1)->get();
    }

    public function getData($producto_id){
        return [
            'data' => Producto::find($producto_id)
        ];
    }
    public function deleteData($producto_id, $activo){
        $producto = Producto::where('id', $producto_id)->update([
            'activo' => $activo
        ]);

        return $producto;
    }

}
