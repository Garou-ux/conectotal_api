<?php

namespace App\Http\Controllers\Api\CatAreas;

use App\Customs\Services\CatAreas\CatAreasService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatArea\CreateCatAreaRequest;
use Illuminate\Http\Request;

class CatAreasController extends Controller
{
    public function __construct(private CatAreasService $catAreaService){}

    public function getDataGridParams(Request $request){
        $dataGridParam = $this->catAreaService->getDataGridParams($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $dataGridParam
        ]);
    }

    public function getGridData(Request $request){
        $gridData = $this->catAreaService->getGridData($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->catAreaService->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function setData(CreateCatAreaRequest $request){
        try {
            $validatedData = $request->all();
            $data = $this->catAreaService->setData($validatedData);
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

    public function deleteData(Request $request){
        $data = $this->catAreaService->deleteData($request->get('id'), 0);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }


}
