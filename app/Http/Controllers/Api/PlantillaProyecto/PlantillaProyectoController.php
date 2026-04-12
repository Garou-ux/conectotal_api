<?php

namespace App\Http\Controllers\Api\PlantillaProyecto;

use App\Customs\Services\PlantillaProyecto\PlantillaProyectoService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlantillaProyecto\SavePlantillaProyectoRequest;
use Illuminate\Http\Request;

class PlantillaProyectoController extends Controller
{
    public function __construct(private PlantillaProyectoService $service)
    {
    }

    public function getDataGridParams(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->service->getDataGridParams($request->all()),
        ]);
    }

    public function setData(SavePlantillaProyectoRequest $request)
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'Plantilla de proyecto guardada correctamente',
                'data' => $this->service->setData($request->validated()),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Creation failed:' . $th->getMessage(),
            ], 500);
        }
    }

    public function getGridData()
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->service->getGridData(),
        ]);
    }

    public function getData(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->service->getData((int) $request->get('id')),
        ]);
    }

    public function getReporteData(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->service->getReporteData((int) $request->get('id')),
        ]);
    }

    public function deleteData(Request $request)
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'Proceso completado',
                'data' => $this->service->deleteData((int) $request->get('id')),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Delete failed:' . $th->getMessage(),
            ], 500);
        }
    }
}
