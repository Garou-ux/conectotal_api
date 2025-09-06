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
        if (!Schema::hasTable('requisiciones_detalles')) {
        Schema::create('requisiciones_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('requisicion_id')->unsigned()->nullable();
            $table->integer('producto_id')->unsigned()->nullable();
            $table->decimal('cantidad', 10,2)->nullable()->default(0);
            $table->decimal('cantidad_pendiente', 10,2)->nullable()->default(0);
            $table->decimal('cantidad_comprada', 10,2)->nullable()->default(0);
            $table->text('descripcion')->nullable();
            $table->text('observacion')->nullable();
            $table->boolean('activo')->nullable()->default(false);
            $table->timestamps();

            // $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onDelete('cascade')->onUpdate('cascade');
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisiciones_detalles');
    }
};
