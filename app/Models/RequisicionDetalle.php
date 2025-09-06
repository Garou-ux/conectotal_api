<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisicionDetalle extends Model
{
    use HasFactory;

    protected $table = 'requisiciones_detalles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'requisicion_id',
        'producto_id',
        'cantidad',
        'cantidad_pendiente',
        'cantidad_comprada',
        'descripcion',
        'observacion',
        'activo'
    ];
}
