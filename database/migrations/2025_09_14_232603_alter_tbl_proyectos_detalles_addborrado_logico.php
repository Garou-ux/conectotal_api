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
        if (Schema::hasTable('proyectos_detalles')) {
            Schema::table('proyectos_detalles', function (Blueprint $table) {
                $table->boolean('borrado_logico')->nullable()->default(false);
            });
        }

        if (Schema::hasTable('proyectos')) {
            Schema::table('proyectos', function (Blueprint $table) {
                $table->boolean('activo')->nullable()->default(true)->change();
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
