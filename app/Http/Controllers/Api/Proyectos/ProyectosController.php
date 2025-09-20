<?php

namespace App\Http\Controllers\Api\Proyectos;

use App\Customs\Services\Proyectos\ProyectosService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    public function __construct(private ProyectosService $proyectosService){}

    public function getDataGridParams(Request $request){
        $dataGridParams = $this->proyectosService->getDataGridParams($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $dataGridParams
        ]);
    }

    public function getGridData(Request $request){
        $gridData = $this->proyectosService->getGridData($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->proyectosService->getData($request->get('id'));

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function setData(Request $request){
        try {
            $validatedData = $request->all();
            $data = $this->proyectosService->setData($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Creado Correctamente',
                'data' => $data
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Creation failed:' . $th->getMessage()
            ], 422);
        }
    }

    public function deleteData(Request $request){
        $data = $this->proyectosService->deleteData($request->get('id'), 0);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
