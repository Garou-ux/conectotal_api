<?php

namespace App\Customs\Services\PlantillaProyecto;

use App\Models\CatalogoSemana;
use App\Models\PlantillaProyecto;
use App\Models\PlantillaProyectoDetalle;
use App\Models\Supervisor;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlantillaProyectoService
{
    public function getDataGridParams($data)
    {
        return [
            [
                'dataField' => 'id',
                'caption' => '# Plantilla',
            ],
            [
                'dataField' => 'supervisor',
                'caption' => 'Supervisor',
            ],
            [
                'dataField' => 'numero_proyecto',
                'caption' => 'No. Proyecto',
            ],
            [
                'dataField' => 'periodo',
                'caption' => 'Semana',
            ],
            [
                'dataField' => 'trabajadores',
                'caption' => 'Trabajadores',
            ],
            [
                'dataField' => 'total_tn',
                'caption' => 'TN',
            ],
            [
                'dataField' => 'total_hes',
                'caption' => 'HES',
            ],
        ];
    }

    public function setData($data)
    {
        return DB::transaction(function () use ($data) {
            $semana = null;

            if (!empty($data['catalogo_semana_id'])) {
                $semana = CatalogoSemana::findOrFail($data['catalogo_semana_id']);
            }

            $payload = [
                'supervisor_id' => $data['supervisor_id'],
                'catalogo_semana_id' => $data['catalogo_semana_id'] ?? null,
                'proyecto_id' => $data['proyecto_id'] ?? null,
                'user_id' => Auth::id(),
                'numero_proyecto' => $data['numero_proyecto'] ?? null,
                'anio' => $semana?->anio ?? (int) ($data['anio'] ?? 0),
                'mes' => $semana?->mes ?? $this->resolveMes($data),
                'semana' => $semana?->semana ?? (int) ($data['semana'] ?? 0),
                'fecha_inicio' => $data['fecha_inicio'] ?? $semana?->fecha_inicio?->toDateString(),
                'fecha_fin' => $data['fecha_fin'] ?? $semana?->fecha_fin?->toDateString(),
                'observaciones' => $data['observaciones'] ?? null,
                'activo' => $data['activo'] ?? true,
            ];

            if (!empty($data['id'])) {
                $plantillaProyecto = PlantillaProyecto::findOrFail($data['id']);
                $plantillaProyecto->update($payload);
            } else {
                $plantillaProyecto = PlantillaProyecto::create($payload);
            }

            $detalleIds = [];

            foreach ($data['detalles'] as $index => $detalleData) {
                $trabajador = !empty($detalleData['trabajador_id'])
                    ? Trabajador::find($detalleData['trabajador_id'])
                    : null;

                $resumen = $this->calcularResumen($detalleData['dias']);

                $detallePayload = [
                    'trabajador_id' => $detalleData['trabajador_id'] ?? null,
                    'orden' => $index + 1,
                    'ficha' => $detalleData['ficha'] ?? $trabajador?->ficha,
                    'nombre_trabajador' => $detalleData['nombre_trabajador'] ?? $this->resolveNombreTrabajador($trabajador),
                    'tn' => $resumen['tn'],
                    'hes' => $resumen['hes'],
                    'hdo' => $resumen['hdo'],
                    'hd' => $resumen['hd'],
                    'ht' => $resumen['ht'],
                    'bono_puntualidad' => $detalleData['bono_puntualidad'] ?? null,
                    'observaciones' => $detalleData['observaciones'] ?? null,
                ];

                if (!empty($detalleData['id'])) {
                    $detalle = PlantillaProyectoDetalle::where('plantilla_proyecto_id', $plantillaProyecto->id)
                        ->findOrFail($detalleData['id']);
                    $detalle->update($detallePayload);
                } else {
                    $detalle = $plantillaProyecto->detalles()->create($detallePayload);
                }

                $detalleIds[] = $detalle->id;
                $diaSemanas = [];

                foreach ($detalleData['dias'] as $diaData) {
                    $diaSemanas[] = (int) $diaData['dia_semana'];

                    $detalle->dias()->updateOrCreate(
                        ['dia_semana' => $diaData['dia_semana']],
                        [
                            'fecha' => $diaData['fecha'] ?? null,
                            'nombre_dia' => $diaData['nombre_dia'] ?? null,
                            'horas_normales' => $diaData['horas_normales'] ?? 0,
                            'horas_extra' => $diaData['horas_extra'] ?? 0,
                            'proyecto_id' => $diaData['proyecto_id'] ?? null,
                            'numero_proyecto' => $diaData['numero_proyecto'] ?? null,
                            'es_descanso' => $diaData['es_descanso'] ?? false,
                            'observaciones' => $diaData['observaciones'] ?? null,
                        ]
                    );
                }

                $detalle->dias()->whereNotIn('dia_semana', $diaSemanas)->delete();
            }

            $plantillaProyecto->detalles()->whereNotIn('id', $detalleIds)->delete();

            return $plantillaProyecto->load([
                'supervisor',
                'semanaCatalogo',
                'detalles.trabajador',
                'detalles.dias',
            ]);
        });
    }

    public function getGridData()
    {
        return PlantillaProyecto::query()
            ->with(['supervisor:id,nombre,apellido_paterno,apellido_materno'])
            ->withCount('detalles')
            ->withSum('detalles as total_tn', 'tn')
            ->withSum('detalles as total_hes', 'hes')
            ->orderByDesc('id')
            ->get()
            ->map(function (PlantillaProyecto $item) {
                return [
                    'id' => $item->id,
                    'supervisor' => trim(collect([
                        $item->supervisor?->nombre,
                        $item->supervisor?->apellido_paterno,
                        $item->supervisor?->apellido_materno,
                    ])->filter()->implode(' ')),
                    'numero_proyecto' => $item->numero_proyecto,
                    'periodo' => sprintf(
                        'Año %s / Mes %s / Semana %s',
                        $item->anio,
                        $item->mes,
                        $item->semana
                    ),
                    'fecha_rango' => trim(($item->fecha_inicio?->format('d/m/Y') ?? '') . ' - ' . ($item->fecha_fin?->format('d/m/Y') ?? '')),
                    'trabajadores' => $item->detalles_count,
                    'total_tn' => (float) ($item->total_tn ?? 0),
                    'total_hes' => (float) ($item->total_hes ?? 0),
                    'activo' => $item->activo,
                ];
            });
    }

    public function getData($id)
    {
        $data = [];

        if ($id > 0) {
            $data = PlantillaProyecto::query()
                ->with([
                    'supervisor',
                    'semanaCatalogo',
                    'detalles.trabajador',
                    'detalles.dias',
                ])
                ->find($id);
        }

        return [
            'data' => $data,
            'supervisores' => Supervisor::query()->orderBy('nombre')->get(),
            'trabajadores' => Trabajador::query()->orderBy('nombre')->get(),
            'semanas' => CatalogoSemana::query()
                ->where('activo', 1)
                ->orderByDesc('anio')
                ->orderBy('semana')
                ->get(),
        ];
    }

    public function getReporteData($id)
    {
        $plantillaProyecto = PlantillaProyecto::query()
            ->with([
                'supervisor',
                'detalles.trabajador',
                'detalles.dias',
            ])
            ->findOrFail($id);

        $diasCabecera = $this->buildDiasCabecera($plantillaProyecto);

        return [
            'encabezado' => [
                'id' => $plantillaProyecto->id,
                'supervisor' => trim(collect([
                    $plantillaProyecto->supervisor?->nombre,
                    $plantillaProyecto->supervisor?->apellido_paterno,
                    $plantillaProyecto->supervisor?->apellido_materno,
                ])->filter()->implode(' ')),
                'numero_proyecto' => $plantillaProyecto->numero_proyecto,
                'anio' => $plantillaProyecto->anio,
                'mes' => $plantillaProyecto->mes,
                'semana' => $plantillaProyecto->semana,
                'fecha_inicio' => $plantillaProyecto->fecha_inicio?->format('Y-m-d'),
                'fecha_fin' => $plantillaProyecto->fecha_fin?->format('Y-m-d'),
            ],
            'columnas' => [
                '#',
                'Ficha',
                'Trabajador',
                'Dias',
                'TN',
                'HES',
                'HDO',
                'HD',
                'HT',
            ],
            'dias' => $diasCabecera,
            'rows' => $plantillaProyecto->detalles->map(function ($detalle, $index) {
                return [
                    'numero' => $index + 1,
                    'ficha' => $detalle->ficha,
                    'trabajador' => $detalle->nombre_trabajador,
                    'tn' => (float) $detalle->tn,
                    'hes' => (float) $detalle->hes,
                    'hdo' => (float) $detalle->hdo,
                    'hd' => (float) $detalle->hd,
                    'ht' => (float) $detalle->ht,
                    'bono_puntualidad' => $detalle->bono_puntualidad,
                    'observaciones' => $detalle->observaciones,
                    'dias' => $detalle->dias->map(function ($dia) {
                        return [
                            'dia_semana' => $dia->dia_semana,
                            'fecha' => $dia->fecha?->format('Y-m-d'),
                            'nombre_dia' => $dia->nombre_dia,
                            'horas_normales' => (float) $dia->horas_normales,
                            'horas_extra' => (float) $dia->horas_extra,
                            'numero_proyecto' => $dia->numero_proyecto,
                            'es_descanso' => $dia->es_descanso,
                            'observaciones' => $dia->observaciones,
                        ];
                    })->values(),
                ];
            })->values(),
        ];
    }

    public function getReporteExcel($id): array
    {
        $plantillaProyecto = PlantillaProyecto::query()
            ->with([
                'supervisor',
                'detalles.trabajador',
                'detalles.dias',
            ])
            ->findOrFail($id);

        $supervisor = trim(collect([
            $plantillaProyecto->supervisor?->nombre,
            $plantillaProyecto->supervisor?->apellido_paterno,
            $plantillaProyecto->supervisor?->apellido_materno,
        ])->filter()->implode(' '));

        $html = view('exports.plantilla-proyecto-reporte', [
            'plantillaProyecto' => $plantillaProyecto,
            'supervisor' => $supervisor,
            'diasCabecera' => $this->buildDiasCabecera($plantillaProyecto),
            'detalles' => $this->ordenarDetallesPorApellido($plantillaProyecto->detalles),
        ])->render();

        return [
            'filename' => sprintf(
                'reporte_tiempo_semana_%s_proyecto_%s.xls',
                $plantillaProyecto->semana,
                preg_replace('/[^A-Za-z0-9_-]+/', '_', $plantillaProyecto->numero_proyecto ?: $plantillaProyecto->id)
            ),
            'content' => $html,
        ];
    }

    public function deleteData($id)
    {
        $plantillaProyecto = PlantillaProyecto::findOrFail($id);
        $plantillaProyecto->delete();

        return $plantillaProyecto;
    }

    private function calcularResumen(array $dias): array
    {
        $diasCollection = collect($dias)
            ->sortBy('dia_semana')
            ->values()
            ->map(function ($dia) {
                return [
                    'horas_normales' => round((float) ($dia['horas_normales'] ?? 0), 2),
                    'horas_extra' => round((float) ($dia['horas_extra'] ?? 0), 2),
                    'es_descanso' => filter_var($dia['es_descanso'] ?? false, FILTER_VALIDATE_BOOLEAN),
                ];
            });

        $tn = round($diasCollection->sum('horas_normales'), 2);
        $hes = round($diasCollection->sum('horas_extra'), 2);

        $descanso = round($diasCollection
            ->where('es_descanso', true)
            ->sum(fn ($dia) => $dia['horas_normales'] + $dia['horas_extra']), 2);

        if ($descanso <= 0 && $diasCollection->isNotEmpty()) {
            $descanso = round((float) $diasCollection->last()['horas_extra'], 2);
        }

        $extrasNoDescanso = round(max(0, $diasCollection
            ->where('es_descanso', false)
            ->sum('horas_extra')), 2);
        $hdo = round(min(8, $descanso), 2);
        $hd = round(min(9, $extrasNoDescanso), 2);
        $ht = round(max(0, $extrasNoDescanso - $hd), 2);

        return compact('tn', 'hes', 'hdo', 'hd', 'ht');
    }

    private function ordenarDetallesPorApellido($detalles)
    {
        return $detalles
            ->sortBy(function ($detalle) {
                $trabajador = $detalle->trabajador;

                if ($trabajador) {
                    return mb_strtolower(trim(collect([
                        $trabajador->apellido_paterno,
                        $trabajador->apellido_materno,
                        $trabajador->nombre,
                    ])->filter()->implode(' ')));
                }

                return mb_strtolower((string) $detalle->nombre_trabajador);
            })
            ->values();
    }

    private function resolveMes(array $data): int
    {
        if (!empty($data['mes'])) {
            return (int) $data['mes'];
        }

        if (!empty($data['fecha_fin'])) {
            return (int) date('n', strtotime($data['fecha_fin']));
        }

        if (!empty($data['fecha_inicio'])) {
            return (int) date('n', strtotime($data['fecha_inicio']));
        }

        return 1;
    }

    private function resolveNombreTrabajador(?Trabajador $trabajador): ?string
    {
        if (!$trabajador) {
            return null;
        }

        return trim(collect([
            $trabajador->nombre,
            $trabajador->apellido_paterno,
            $trabajador->apellido_materno,
        ])->filter()->implode(' '));
    }

    private function buildDiasCabecera(PlantillaProyecto $plantillaProyecto): array
    {
        $dias = [];

        if ($plantillaProyecto->fecha_inicio) {
            $cursor = $plantillaProyecto->fecha_inicio->copy();

            for ($i = 1; $i <= 7; $i++) {
                $dias[] = [
                    'dia_semana' => $i,
                    'fecha' => $cursor->format('Y-m-d'),
                    'label' => $cursor->translatedFormat('D d/m'),
                ];

                $cursor->addDay();
            }
        }

        return $dias;
    }
}
