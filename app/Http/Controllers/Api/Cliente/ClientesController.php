<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Customs\Services\Cliente\ClienteService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\CreateClienteRequest;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct(private ClienteService $clienteService){}

    public function getDataGridParams(Request $request){
        $dataGridParam = $this->clienteService->getDataGridParams($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $dataGridParam
        ]);
    }

    public function setData(CreateClienteRequest $request){
        try {
            $validatedData = $request->all();
            $data = $this->clienteService->setData($validatedData);
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
        $gridData = $this->clienteService->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }   

    public function getData(Request $request){
        $data = $this->clienteService->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function deleteData(Request $request){
        $data = $this->clienteService->deleteData($request->get('id'), 0);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
