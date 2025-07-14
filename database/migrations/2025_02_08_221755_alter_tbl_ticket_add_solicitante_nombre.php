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
        if (Schema::hasTable('tickets')) {
            if ( !Schema::hasColumn('tickets', 'nombre_solicitante') ) {
                Schema::table('tickets', function (Blueprint $table) {
                    $table->string('nombre_solicitante', 50)->nullable()->after('ticket_categoria_id');
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
