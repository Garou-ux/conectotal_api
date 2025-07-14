<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion',
        'activo'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where(
            'activo', $activo
        );
    }
}
