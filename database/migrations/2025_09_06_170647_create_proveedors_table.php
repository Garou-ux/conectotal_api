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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable();
            $table->string('rfc', 20)->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('razon_social')->nullable();
            $table->string('regimen_fiscal')->nullable();
            $table->integer('limite_credito')->nullable();
            $table->integer('dias_credito')->nullable();
            $table->string('forma_pago')->nullable();
            $table->string('metodo_pago')->nullable();
            $table->string('satcat_uso_cfdi_clave')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero_exterior')->nullable();
            $table->string('numero_interior')->nullable();
            $table->string('satcat_paises_clave')->nullable();
            $table->string('satcat_codigos_postales_codigo_postal')->nullable();
            $table->string('satcat_estados_clave')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->boolean('activo')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
