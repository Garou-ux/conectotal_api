<?php

namespace App\Http\Controllers\Api\Plantilla;

use App\Customs\Services\Plantilla\PlantillaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Plantilla\CreatePlantilaRequest;

class PlantillaController extends Controller
{
    public function __construct(private PlantillaService $plantillaService){}

    public function getDataGridParams(Request $request){
        $dataGridParams = $this->plantillaService->getDataGridParams($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $dataGridParams
        ]);
    }

    public function setData(CreatePlantilaRequest $request){
        $validatedData = $request->all();
        try {
            $plantilla = $this->plantillaService->setData($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Creado correctamente',
                'data' => $plantilla
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Creation failed:' . $th->getMessage()
            ], 500);
        }
    }

    public function getGridData(){
        $gridData = $this->plantillaService->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->plantillaService->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }


    public function deleteData(Request $request){
        try {
            $data = $this->plantillaService->deleteData($request->get('id'), 0);
            return response()->json([
                'status' => 'success',
                'message' => 'Proceso completado',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Updating failed:' . $th->getMessage()
            ], 500);
        }
    }
}
