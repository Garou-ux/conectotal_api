<?php

namespace App\Customs\Services\Ticket;

use App\Models\TicketCategoria;

class TicketCategoriaService{

    public function setData($data){
        $ticket = TicketCategoria::updateOrCreate([
            'id' => $data['id']
        ], $data);
        return $ticket;
    }

    public function deleteData(TicketCategoria $ticketCategoria, $data){
        $ticketCategoria->update([
            'activo' => $data['activo']
        ]);

        return $ticketCategoria;
    }

    public function getGridData(){
        return TicketCategoria::ofActivo(1)->get();
    }

    public function getData($ticket_categoria_id){
        return TicketCategoria::find($ticket_categoria_id);
    }
}
