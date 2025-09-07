<?php

use App\Models\Rol;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roles = [
            ['descripcion' => 'Gerencial', 'activo' => 1],
            ['descripcion' => 'Administrativo', 'activo' => 1],
            ['descripcion' => 'Recursos Humanos', 'activo' => 1],
            ['descripcion' => 'Adquisiciones y Compras', 'activo' => 1],
            ['descripcion' => 'Recursos Humanos', 'activo' => 1],
            ['descripcion' => 'Coordinador Almacen', 'activo' => 1],
        ];

        foreach ($roles as $rol) {
            Rol::create($rol);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
