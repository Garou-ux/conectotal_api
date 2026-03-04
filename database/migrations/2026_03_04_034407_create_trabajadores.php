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

        //tabla de supervisores
        if (!Schema::hasTable('supervisores')) {
            Schema::create('supervisores', function (Blueprint $table) {
                $table->id();
                $table->string('nombre')->nullable();
                $table->string('apellido_paterno')->nullable();
                $table->string('apellido_materno')->nullable();
                $table->string('ficha')->nullable();
                $table->string('rfc')->nullable();
                $table->string('curp')->nullable();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('trabajadores')) {
            Schema::create('trabajadores', function (Blueprint $table) {
                $table->id();
                $table->foreignId('supervisor_id')->nullable()->constrained('supervisores')->nullOnDelete();
                $table->string('nombre')->nullable();
                $table->string('apellido_paterno')->nullable();
                $table->string('apellido_materno')->nullable();
                $table->string('ficha')->nullable();
                $table->string('rfc')->nullable();
                $table->string('curp')->nullable();
                $table->date('fecha_contratacion')->nullable();

                $table->timestamps();
                $table->softDeletes();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};
