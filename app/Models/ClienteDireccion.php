<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteDireccion extends Model
{
    use HasFactory;

    protected $table = 'clientes_direcciones';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cliente_id',
        'calle',
        'estado_id',
        'numero_exterior',
        'numero_interior',
        'telefono',
        'codigo_postal',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('clientes_direcciones.activo', $activo);
    }

    public function scopeOfClienteId($query, $cliente_id){
        return $query->where(
            'cliente_id', $cliente_id
        );
    }
}
