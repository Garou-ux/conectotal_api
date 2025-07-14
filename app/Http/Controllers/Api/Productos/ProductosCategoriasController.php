<?php

namespace App\Http\Controllers\Api\Productos;

use App\Customs\Services\Productos\ProductosCategoriasService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Producto\CreateProductoCategoriaRequest;
use Illuminate\Http\Request;

class ProductosCategoriasController extends Controller
{
    public function __construct(private ProductosCategoriasService $productosCategoriasService){}

    public function setData(CreateProductoCategoriaRequest $request){
        try {
            $validatedData = $request->all();
            $data = $this->productosCategoriasService->setData($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Creado Correctamente',
                'data' => $data
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Creation failed:' .$th->getMessage()
            ],500);
        }
    }

    public function getGridData(){
        $gridData = $this->productosCategoriasService->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->productosCategoriasService->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function deleteData(Request $request){
        $data = $this->productosCategoriasService->deleteData($request->get('id'), 0);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
