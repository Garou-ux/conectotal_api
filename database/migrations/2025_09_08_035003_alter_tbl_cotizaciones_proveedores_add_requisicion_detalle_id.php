<?php

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
        if (Schema::hasTable('cotizaciones_proveedores_detalles')) {
            Schema::table('cotizaciones_proveedores_detalles', function (Blueprint $table) {
                $table->integer('requisicion_id')->unsigned()->nullable();
                $table->integer('requisicion_detalle_id')->unsigned()->nullable();
            });
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
