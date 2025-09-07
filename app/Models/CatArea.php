<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatArea extends Model
{
    use HasFactory;

    protected $table = 'cat_areas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion',
        'activo',
        'empresa_id'
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where(
            'cat_areas.activo', $activo
        );
    }
}
