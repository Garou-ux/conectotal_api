<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategoria extends Model
{
    use HasFactory;

    protected $table = 'tickets_categorias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion',
        'activo'
    ];


    public function scopeOfActivo($query, $activo){
        return $query->where('activo', $activo);
    }
}
