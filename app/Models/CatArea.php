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
}
