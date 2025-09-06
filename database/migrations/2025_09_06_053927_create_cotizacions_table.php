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
        Schema::create('cotizaciones_proveedores', function (Blueprint $table) {
            $table->id();
            $table->integer('requisicion_id')->unsigned()->nullable();
            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->integer('estatus_id')->unsigned()->nullable();
            $table->date('fecha')->nullable();
            $table->text('observaciones')->nullable();
            $table->decimal('subtotal', 10,2)->default(0)->nullable();
            $table->decimal('iva', 10,2)->default(0)->nullable();
            $table->decimal('total', 10,2)->default(0)->nullable();
            $table->boolean('activo')->nullable()->default(false);
            $table->integer('empresa_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacions');
    }
};
