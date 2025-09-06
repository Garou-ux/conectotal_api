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
        Schema::create('cotizaciones_proveedores_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('cotizacion_proveedor_id')->unsigned()->nullable();
            $table->integer('producto_id')->unsigned()->nullable();
            $table->text('descripcion')->nullable();
            $table->decimal('valor_unitario', 10,2)->nullable();
            $table->decimal('importe', 10,2)->nullable();
            $table->decimal('descuento', 10, 2)->nullable();
            $table->decimal('iva', 10,2)->nullable();
            $table->decimal('total', 10,2)->nullable();
            $table->boolean('activo')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacion_proveedor_detalles');
    }
};
