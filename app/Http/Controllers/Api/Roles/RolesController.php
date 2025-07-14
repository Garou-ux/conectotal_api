<?php

namespace App\Http\Controllers\Api\Roles;

use App\Customs\Services\Roles\RolesService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\CreateRolRequest;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct(private RolesService $rolesService){}

    public function setData(CreateRolRequest $request){
        try {
            $validatedData = $request->all();
            $data = $this->rolesService->setData($validatedData);
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
        $gridData = $this->rolesService->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->rolesService->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function deleteData(Request $request){
        $data = $this->rolesService->deleteData($request->get('id'), 0);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
