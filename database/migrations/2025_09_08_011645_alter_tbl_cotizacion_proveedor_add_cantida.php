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
        if (Schema::hasTable('cotizaciones_proveedores_detalles')) {
            Schema::table('cotizaciones_proveedores_detalles', function (Blueprint $table) {
                $table->decimal('cantidad', 10,2)->nullable()->default(0);
                $table->boolean('borrado_logico')->nullable()->default(false);
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
