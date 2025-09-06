<?php

namespace App\Http\Controllers\Api\CotizacionesProveedor;
use App\Customs\Services\CotizacionProveedores\CotizacionProveedoresService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CotizacionesProveedoresController extends Controller
{
    public function __construct(private CotizacionProveedoresService $cotizacionProveedoresService){}

    public function getDataGridParams(Request $request){
        $dataGridParams = $this->cotizacionProveedoresService->getDataGridParams($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $dataGridParams
        ]);
    }

    public function getGridData(Request $request){
        $gridData = $this->cotizacionProveedoresService->getGridData($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->cotizacionProveedoresService->getData($request->get('id'));

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function setData(Request $request){
        try {
            $validatedData = $request->all();
            $data = $this->cotizacionProveedoresService->setData($validatedData);
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

}
