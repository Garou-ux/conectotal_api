<?php

namespace App\Http\Controllers\Api\Requisiciones;

use App\Customs\Services\Requisiciones\RequisicionesService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequisicionesController extends Controller
{
    public function __construct(private RequisicionesService $requisicionesService){}

     public function getDataGridParams(Request $request){
        $dataGridParam = $this->requisicionesService->getDataGridParams($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $dataGridParam
        ]);
    }

    public function getGridData(Request $request){
        $gridData = $this->requisicionesService->getGridData($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->requisicionesService->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }


    public function setData(Request $request){
        // try {
            $validatedData = $request->all();
            $data = $this->requisicionesService->setData($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Creado Correctamente',
                'data' => $data
            ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Creation failed:' . $th->getMessage()
        //     ], 500);
        // }
    }

    public function deleteData(Request $request){
        $data = $this->requisicionesService->deleteData($request->get('id'), 0);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getRequisicionesForCotizacion(Request $request){
        $data = $this->requisicionesService->getRequisicionesForCotizacion();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
