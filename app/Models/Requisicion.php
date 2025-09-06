<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    use HasFactory;

    protected $table = 'requisiciones';

    protected $primaryKey = 'id';

    protected $fillable = [
        'empleado_id',
        'cat_area_id',
        'estatus_id',
        'fecha',
        'observaciones',
        'activo',
        'empresa_id',
        'user_id'
    ];
}
