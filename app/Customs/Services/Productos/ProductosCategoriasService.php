<?php


namespace App\Customs\Services\Productos;

use App\Models\ProductoCategoria;

class ProductosCategoriasService {

    public function setData($data){
        $productoCategoria = ProductoCategoria::updateOrCreate([
            'id' => $data['id']
        ], $data);

        return $productoCategoria;
    }

    public function getGridData(){
        return ProductoCategoria::ofActivo(1)->get();
    }

    public function getData($id){
        return [
            'data' => ProductoCategoria::find($id)
        ];
    }

    public function deleteData($id, $activo){
        $productoCategoria = ProductoCategoria::where(
            'id', $id
        )->update([
            'activo' => $activo
        ]);

        return $productoCategoria;
    }
}
