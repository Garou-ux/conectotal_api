<?php

namespace App\Customs\Services\Ticket;

use App\Models\Ticket;
use App\Models\TicketFecha;
use Carbon\Carbon;

class TicketService{

    public function setData($data){
        // $ticket = auth()->user()->tickets()->updateOrCreate(['id' => $data['id']],$data);
        $ticket = Ticket::updateOrCreate([
            'id' => $data['id']
        ], $data);

        if( isset($data['tickets_fechas']) ){
            foreach ($data['tickets_fechas'] as $value) {
                $value['ticket_id'] = $ticket->id;
                TicketFecha::updateOrCreate([
                    'id' => $value['id']
                ], $value);
            }
        }else{
            TicketFecha::updateOrCreate([
                'id' => 1
            ],[
                'ticket_id' => $ticket->id,
                'user_id' => $data['user_id'],
                'estatus_id' => 1,
                'fecha_asignado' => Carbon::now()->format('Y-m-d')
            ]);
        }

        return $ticket;
    }

    public function getGridData(){
        return Ticket::ofActivo(1)->get();
    }

    public function getData($id){
        return [
            'data' => Ticket::find($id),
            'fechas' => TicketFecha::ofTicketId($id)->ofActivo(1)->get()
        ];
    }

    public function deleteData(Ticket $ticket, $activo){
        if( $ticket->user_id !== auth()->user()->id ){
            throw new \Illuminate\Auth\Access\AuthorizationException('You do not have permission to update this ticket.');
        }

        $ticket->update([
            'activo' => $activo
        ]);

        return $ticket;
    }
}
