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
        Schema::create('plantilla_proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supervisor_id')->nullable()->constrained('supervisores')->nullOnDelete();
            $table->foreignId('catalogo_semana_id')->nullable()->constrained('catalogo_semanas')->nullOnDelete();
            $table->foreignId('proyecto_id')->nullable()->constrained('proyectos')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('numero_proyecto', 50)->nullable();
            $table->unsignedSmallInteger('anio');
            $table->unsignedTinyInteger('mes');
            $table->unsignedTinyInteger('semana');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['supervisor_id', 'anio', 'semana']);
        });

        Schema::create('plantilla_proyecto_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_proyecto_id')->constrained('plantilla_proyectos')->cascadeOnDelete();
            $table->foreignId('trabajador_id')->nullable()->constrained('trabajadores')->nullOnDelete();
            $table->unsignedSmallInteger('orden')->default(0);
            $table->string('ficha', 50)->nullable();
            $table->string('nombre_trabajador')->nullable();
            $table->decimal('tn', 8, 2)->default(0);
            $table->decimal('hes', 8, 2)->default(0);
            $table->decimal('hdo', 8, 2)->default(0);
            $table->decimal('hd', 8, 2)->default(0);
            $table->decimal('ht', 8, 2)->default(0);
            $table->boolean('bono_puntualidad')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();

            $table->index(['plantilla_proyecto_id', 'orden']);
        });

        Schema::create('plantilla_proyecto_detalle_dias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_proyecto_detalle_id')
                ->constrained('plantilla_proyecto_detalles', 'id', 'ppdd_detalle_fk')
                ->cascadeOnDelete();
            $table->unsignedTinyInteger('dia_semana');
            $table->date('fecha')->nullable();
            $table->string('nombre_dia', 20)->nullable();
            $table->decimal('horas_normales', 8, 2)->default(0);
            $table->decimal('horas_extra', 8, 2)->default(0);
            $table->foreignId('proyecto_id')->nullable()->constrained('proyectos')->nullOnDelete();
            $table->string('numero_proyecto', 50)->nullable();
            $table->boolean('es_descanso')->default(false);
            $table->string('observaciones')->nullable();
            $table->timestamps();

            $table->unique(['plantilla_proyecto_detalle_id', 'dia_semana'], 'pp_detalle_dias_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_proyecto_detalle_dias');
        Schema::dropIfExists('plantilla_proyecto_detalles');
        Schema::dropIfExists('plantilla_proyectos');
    }
};
