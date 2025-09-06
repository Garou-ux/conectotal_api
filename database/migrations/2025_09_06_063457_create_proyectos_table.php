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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->integer('cotizacion_proveedor_id')->unsigned()->nullable();
            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->integer('cat_estatus_id')->unsigned()->nullable();
            $table->date('fecha')->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('proyectos');
    }
};
