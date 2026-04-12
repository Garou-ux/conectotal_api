<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supervisor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'supervisores';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'ficha',
        'rfc',
        'curp',
        'user_id'
    ];

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class);
    }

    public function plantillaProyectos()
    {
        return $this->hasMany(PlantillaProyecto::class);
    }
}
