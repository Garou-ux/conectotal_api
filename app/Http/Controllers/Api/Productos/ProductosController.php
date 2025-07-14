<?php

namespace App\Http\Controllers\Api\Productos;

use App\Customs\Services\Productos\ProductosService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Producto\CreateProductoRequest;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function __construct(private ProductosService $productosService){}

    public function setData(CreateProductoRequest $request){
        try {
            $validatedData = $request->all();
            $data = $this->productosService->setData($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Creado Correctamente',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Creation failed:' . $th->getMessage()
            ], 500);
        }
    }

    public function getGridData(){
        $gridData = $this->productosService->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->productosService->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function deleteData(Request $request){
        $data = $this->productosService->deleteData($request->get('id'), 0);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
