<?php

namespace App\Http\Controllers\Api\Proveedor;

use App\Customs\Services\Proveedor\ProveedorService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct(private ProveedorService $proveedor_service){}

    public function getDataGridParams(Request $request){
        $dataGridParam = $this->proveedor_service->getDataGridParams($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $dataGridParam
        ]);
    }

    public function setData(Request $request){
        try {
            $validatedData = $request->all();
            $data = $this->proveedor_service->setData($validatedData);
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
        $gridData = $this->proveedor_service->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->proveedor_service->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function deleteData(Request $request){
        $data = $this->proveedor_service->deleteData($request->get('id'), 0);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
