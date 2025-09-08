<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'rfc',
        'email',
        'razon_social',
        'activo',
        'regimen_fiscal',
        'limite_credito',
        'dias_credito',
        'forma_pago',
        'metodo_pago',
        'satcat_uso_cfdi_clave',
        'calle',
        'numero_exterior',
        'numero_interior',
        'satcat_paises_clave',
        'satcat_codigos_postales_codigo_postal',
        'satcat_estados_clave',
        'empresa_id',
    ];

    public function scopeOfActivo($query, $activo){
        return $query->where(
            'activo', 1
        );
    }

    public function scopeOfProveedorId($query, $id){
        return $query->where(
            'proveedores.id', $id
        );
    }
}
