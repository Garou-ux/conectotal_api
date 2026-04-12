<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catalogo_semanas', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('anio');
            $table->unsignedTinyInteger('mes');
            $table->unsignedTinyInteger('semana');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('descripcion', 120);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->unique(['anio', 'semana']);
            $table->index(['anio', 'mes']);
        });

        $now = now();
        $rows = [];

        for ($year = 2024; $year <= 2035; $year++) {
            $start = Carbon::create($year, 1, 1)->startOfDay()->previous(Carbon::THURSDAY);
            $nextStart = Carbon::create($year + 1, 1, 1)->startOfDay()->previous(Carbon::THURSDAY);
            $week = 1;

            while ($start->lt($nextStart)) {
                $end = $start->copy()->addDays(6);

                $rows[] = [
                    'anio' => $year,
                    'mes' => (int) $end->month,
                    'semana' => $week,
                    'fecha_inicio' => $start->toDateString(),
                    'fecha_fin' => $end->toDateString(),
                    'descripcion' => sprintf(
                        'Semana %d (%s al %s)',
                        $week,
                        $start->format('d/m/Y'),
                        $end->format('d/m/Y')
                    ),
                    'activo' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                $start->addWeek();
                $week++;
            }
        }

        DB::table('catalogo_semanas')->insert($rows);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_semanas');
    }
};
