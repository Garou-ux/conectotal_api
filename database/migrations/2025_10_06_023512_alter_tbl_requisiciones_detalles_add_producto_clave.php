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
        if (Schema::hasTable('requisiciones_detalles')) {
            if (!Schema::hasColumn('requisiciones_detalles', 'producto_clave')) {
                Schema::table('requisiciones_detalles', function (Blueprint $table) {
                    $table->string('producto_clave')->nullable();
                });
            }
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
