<?php

namespace App\Http\Controllers\Api\Supervisor;

use App\Http\Controllers\Controller;

use App\Customs\Services\Supervisores\SupervisorService;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __construct(private SupervisorService $service){}

    public function getDataGridParams(Request $request){
        $dataGridParam = $this->service->getDataGridParams($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $dataGridParam
        ]);
    }

    public function setData(Request $request){
        try {
            $validatedData = $request->all();
            $data = $this->service->setData($validatedData);
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
        $gridData = $this->service->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->service->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function deleteData(Request $request){
        $data = $this->service->deleteData($request->get('id'), 0);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }


}
