<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFecha extends Model
{
    use HasFactory;

    protected $table = 'tickets_fechas';

    protected $fillable = [
        'ticket_id',
        'user_id',
        'estatus_id',
        'fecha_asignado',
        'fecha_cerrado',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where(
            'tickets_fechas.activo', $activo
        );
    }

    public function scopeOfTicketId($query, $ticket_id){
        return $query->where(
            'tickets_fechas.ticket_id', $ticket_id
        );
    }
}
