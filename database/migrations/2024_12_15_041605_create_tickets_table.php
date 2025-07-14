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

        //categorias de los tickets
        if ( !Schema::hasTable('tickets_categorias') ) {
            Schema::create('tickets_categorias', function (Blueprint $table) {
                $table->id();
                $table->string('descripcion')->nullable();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });
        }

        //form principal de tickets
        if ( !Schema::hasTable('tickets') ) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('plantilla_id')->constrained('plantillas')->cascadeOnDelete();//usuario/plantilla que lo solicita
                $table->foreignId('ticket_categoria_id')->constrained('tickets_categorias')->cascadeOnDelete();
                $table->foreignId('estatus_id')->constrained('estatus')->cascadeOnDelete();
                $table->string('titulo',50)->nullable();
                $table->text('descripcion')->nullable();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });
        }

        //tabla para mostrar las fechas movimientos de los tickets, la voy a usar como log tmb
        if ( !Schema::hasTable('tickets_fechas') ) {
            Schema::create('tickets_fechas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ticket_id')->constrained('tickets')->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); //usuario que hizo el movimiento
                $table->foreignId('estatus_id')->constrained('estatus')->cascadeOnDelete(); // estatus nuevo del ticket
                $table->dateTime('fecha_asignado')->nullable();
                $table->dateTime('fecha_cerrado')->nullable();
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });
        }


        if ( !Schema::hasTable('tickets_respuestas') ) {
            Schema::create('tickets_respuestas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ticket_id')->constrained('tickets')->cascadeOnDelete(); // ticket a respuesta
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); //usuario que respondio
                $table->text('descripcion')->nullable(); //texto
                $table->boolean('activo')->nullable()->default(true);
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
