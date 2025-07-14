<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Customs\Services\Ticket\TicketCategoriaService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateTicketCategoriaRequest;
use App\Models\TicketCategoria;
use Illuminate\Http\Request;

class TicketsCategoriasController extends Controller
{
    public function __construct(private TicketCategoriaService $ticketCategoriaService){}

    public function setData(CreateTicketCategoriaRequest $request){
        try {
            $validatedData = $request->all();
            $data = $this->ticketCategoriaService->setData($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Creado correctamente.',
                'data' => $data
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Creation failed:' . $th->getMessage()
            ], 500);
        }
    }

    public function getGridData(){
        $gridData = $this->ticketCategoriaService->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->ticketCategoriaService->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }


    public function deleteData(Request $request, TicketCategoria $ticketCategoria){
        try {
            $data = $this->ticketCategoriaService->deleteData($ticketCategoria, $request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Updated successfuly',
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
