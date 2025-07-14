<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketRespuesta extends Model
{
    use HasFactory;

    protected $table = 'tickets_respuestas';

    protected $fillable = [
        'ticket_id',
        'user_id',
        'descripcion',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('tickets_respuestas.activo', $activo);
    }
}
