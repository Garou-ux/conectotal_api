<?php

use App\Models\CatArea;
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

        if (Schema::hasTable('plantillas')) {
            Schema::table('plantillas', function (Blueprint $table) {
                $table->integer('cat_area_id')->unsigned()->nullable();
            });
        }

        $areas = [
            ['descripcion' => 'Direccion', 'activo' => 1],
            ['descripcion' => 'Gerencia', 'activo' => 1],
            ['descripcion' => 'Operaciones', 'activo' => 1],
            ['descripcion' => 'Adquisiciones y Compras', 'activo' => 1],
            ['descripcion' => 'Recursos Humanos', 'activo' => 1],
            ['descripcion' => 'Almacen', 'activo' => 1],
            ['descripcion' => 'Contabilidad', 'activo' => 1],
            ['descripcion' => 'Operaciones', 'activo' => 1],
        ];

        foreach ($areas as $area) {
            CatArea::create($area);
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
