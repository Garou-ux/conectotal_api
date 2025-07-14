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
        if ( !Schema::hasTable('estatus') ) {
            Schema::create('estatus', function (Blueprint $table) {
                $table->id();
                $table->string('descripcion', 100)->nullable();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });
        }

        //roles
        if ( !Schema::hasTable('roles') ) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('descripcion')->nullable();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });
        }

        //tabla de plantilla para los personales
        if ( !Schema::hasTable('plantillas') ) {
            Schema::create('plantillas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('estatus_id')->constrained('estatus')->cascadeOnDelete();
                $table->foreignId('rol_id')->constrained('roles')->cascadeOnDelete();
                $table->string('nombre', 100)->nullable();
                $table->string('apellido_paterno', 100)->nullable();
                $table->string('apellido_materno', 100)->nullable();
                $table->string('rfc', 20)->nullable();
                $table->string('email')->nullable()->unique();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });

        }



        //direcciones
        // Tabla de Paises
        if (!Schema::hasTable('countries')) {
            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('iso_code', 3)->unique(); // Código ISO (ejemplo: MEX)
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });

        }

         // Tabla de Estados
         if ( !Schema::hasTable('states')) {
             Schema::create('states', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->unsignedBigInteger('country_id');
                $table->string('abbreviation', 10)->nullable(); // Ejemplo: CDMX, GTO
                $table->timestamps();

                $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            });

         }

        // Tabla de Municipios
        if (!Schema::hasTable('municipalities')) {
            Schema::create('municipalities', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->unsignedBigInteger('state_id');
                $table->timestamps();

                $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            });

        }

        // Tabla de Colonias
        if (!Schema::hasTable('colonies')) {
            Schema::create('colonies', function (Blueprint $table) {
                $table->id();
                $table->string('name', 150);
                $table->unsignedBigInteger('municipality_id');
                $table->unsignedInteger('postal_code');
                $table->timestamps();

                $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
            });
        }

        // Tabla de Calles (opcional si necesitas más detalle)
        if ( !Schema::hasTable('streets') ) {
            Schema::create('streets', function (Blueprint $table) {
                $table->id();
                $table->string('name', 150);
                $table->unsignedBigInteger('colony_id');
                $table->timestamps();

                $table->foreign('colony_id')->references('id')->on('colonies')->onDelete('cascade');
            });

        }

        //clientes
        if ( !Schema::hasTable('clientes') ) {
            Schema::create('clientes', function (Blueprint $table) {
                $table->id();
                $table->string('nombre', 100)->nullable();
                $table->string('rfc', 20)->nullable();
                $table->string('email')->nullable()->unique();
                $table->string('razon_social')->nullable();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });
        }

        if ( !Schema::hasTable('clientes_direcciones') ) {
            Schema::create('clientes_direcciones', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
                $table->string('calle')->nullable();
                $table->unsignedBigInteger('estado_id');
                $table->string('numero_exterior')->nullable();
                $table->string('numero_interior')->nullable();
                $table->integer('telefono')->nullable();
                $table->integer('codigo_postal')->nullable();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();

                $table->foreign('estado_id')->references('id')->on('states')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estatus');
    }
};
