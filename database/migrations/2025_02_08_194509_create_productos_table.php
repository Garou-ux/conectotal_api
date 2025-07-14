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

        if ( !Schema::hasTable('productos_categorias') ) {
            Schema::create('productos_categorias', function (Blueprint $table) {
                $table->id();
                $table->string('descripcion')->nullable();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });
        }

        if ( !Schema::hasTable('productos') ) {
            Schema::create('productos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('producto_categoria_id')->nullable();
                $table->string('clave', 80)->nullable();
                $table->text('descripcion')->nullable();
                $table->string('clave_sat')->nullable();
                $table->boolean('es_servicio')->nullable()->default(false);
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();

                $table->foreign('producto_categoria_id')
                ->references('id')->on('productos_categorias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
