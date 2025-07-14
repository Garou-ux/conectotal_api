<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'rfc',
        'email',
        'razon_social',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where('clientes.activo', $activo);
    }
}
