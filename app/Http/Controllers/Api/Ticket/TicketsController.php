<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Customs\Services\Ticket\TicketService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ticket\CreateTicketRequest;

use App\Models\Ticket;

class TicketsController extends Controller
{
    public function __construct(private TicketService $ticket){}

    public function setData(CreateTicketRequest $request){
        $validatedData = $request->all();
        try {
            $ticket = $this->ticket->setData($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket creado correctamente',
                'data' => $ticket
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Creation failed:' . $th->getMessage()
            ], 500);
        }
    }

    public function getGridData(){
        $gridData = $this->ticket->getGridData();
        return response()->json([
            'status' => 'success',
            'data' => $gridData
        ]);
    }

    public function getData(Request $request){
        $data = $this->ticket->getData($request->get('id'));
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function deleteData(Request $request, Ticket $ticket){
        try {
            $data = $this->ticket->deleteData($ticket, $request->activo);
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket updated successfuly',
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
