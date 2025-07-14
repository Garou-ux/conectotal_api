<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'cliente_id',
        'ticket_categoria_id',
        'nombre_solicitante',
        'estatus_id',
        'titulo',
        'descripcion',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('tickets.activo', $activo);
    }
}
