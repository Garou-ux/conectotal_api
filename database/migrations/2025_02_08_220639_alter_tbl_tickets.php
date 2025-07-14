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
            if (Schema::hasColumn('tickets', 'plantilla_id')) {
                Schema::table('tickets', function (Blueprint $table) {
                    $table->dropForeign('tickets_plantilla_id_foreign');
                    $table->dropColumn('plantilla_id');
                });
            }

            Schema::table('tickets', function (Blueprint $table) {
                $table->unsignedBigInteger('cliente_id')->nullable()->after('user_id');

                $table->foreign('cliente_id')
                ->references('id')->on('clientes')
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
        //
    }
};
