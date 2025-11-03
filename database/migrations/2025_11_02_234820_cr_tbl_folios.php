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
        if (!Schema::hasTable('folios')) {
            Schema::create('folios', function (Blueprint $table) {
                $table->id();
                $table->char('serie', 1); // R, C, P
                $table->integer('anio');
                $table->tinyInteger('mes');
                $table->integer('consecutivo');
                $table->string('folio')->unique(); // R-02-2025-0001
                $table->timestamps();
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
