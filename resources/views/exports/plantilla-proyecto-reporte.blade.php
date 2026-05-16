@php
    $formatNumber = function ($value) {
        $number = number_format((float) $value, 2, '.', '');
        return rtrim(rtrim($number, '0'), '.');
    };
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            font-family: Calibri, Arial, sans-serif;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: middle;
        }

        .title {
            background: #f4b183;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .subtitle {
            background: #d9e2f3;
            font-weight: bold;
            text-align: center;
        }

        .header {
            background: #bfbfbf;
            font-weight: bold;
            text-align: center;
        }

        .normal {
            background: #fff2cc;
        }

        .extra {
            background: #ddebf7;
        }

        .project {
            background: #e2f0d9;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .worker {
            font-weight: bold;
            min-width: 260px;
        }

        .day {
            min-width: 62px;
        }

        .notes {
            min-width: 180px;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td colspan="19" class="title">REPORTE DE TIEMPO</td>
    </tr>
    <tr>
        <td colspan="19" class="subtitle">
            SEMANA NO. {{ $plantillaProyecto->semana }}
            REPORTE DE TIEMPO DEL {{ optional($plantillaProyecto->fecha_inicio)->format('d/m/Y') }}
            AL {{ optional($plantillaProyecto->fecha_fin)->format('d/m/Y') }}
        </td>
    </tr>
    <tr>
        <td colspan="4"><strong>Supervisor:</strong> {{ $supervisor }}</td>
        <td colspan="4"><strong>Proyecto:</strong> {{ $plantillaProyecto->numero_proyecto }}</td>
        <td colspan="4"><strong>Año:</strong> {{ $plantillaProyecto->anio }}</td>
        <td colspan="7"><strong>Observaciones:</strong> {{ $plantillaProyecto->observaciones }}</td>
    </tr>
    <tr>
        <th class="header">Num.</th>
        <th class="header">Ficha</th>
        <th class="header">Nombre del Trabajador</th>
        <th class="header">Concepto</th>
        @foreach ($diasCabecera as $dia)
            <th class="header day">{{ $dia['label'] }}</th>
        @endforeach
        <th class="header">TN</th>
        <th class="header">HES</th>
        <th class="header">HDO</th>
        <th class="header">HD</th>
        <th class="header">HT</th>
        <th class="header">Bono puntualidad</th>
        <th class="header notes">Observaciones</th>
    </tr>
    @foreach ($detalles as $index => $detalle)
        @php
            $diasPorSemana = $detalle->dias->keyBy('dia_semana');
        @endphp
        <tr>
            <td rowspan="3" class="center">{{ $index + 1 }}</td>
            <td rowspan="3" class="center">{{ $detalle->ficha }}</td>
            <td rowspan="3" class="worker">{{ $detalle->nombre_trabajador }}</td>
            <td class="normal">Tiempo Normal</td>
            @foreach ($diasCabecera as $diaCabecera)
                @php $dia = $diasPorSemana->get($diaCabecera['dia_semana']); @endphp
                <td class="normal right">{{ $dia ? $formatNumber($dia->horas_normales) : '' }}</td>
            @endforeach
            <td class="right">{{ $formatNumber($detalle->tn) }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td rowspan="3" class="center">{{ $detalle->bono_puntualidad ? 'SI' : '' }}</td>
            <td rowspan="3">{{ $detalle->observaciones }}</td>
        </tr>
        <tr>
            <td class="extra">Tiempo Extra</td>
            @foreach ($diasCabecera as $diaCabecera)
                @php $dia = $diasPorSemana->get($diaCabecera['dia_semana']); @endphp
                <td class="extra right">{{ $dia ? $formatNumber($dia->horas_extra) : '' }}</td>
            @endforeach
            <td></td>
            <td class="right">{{ $formatNumber($detalle->hes) }}</td>
            <td class="right">{{ $formatNumber($detalle->hdo) }}</td>
            <td class="right">{{ $formatNumber($detalle->hd) }}</td>
            <td class="right">{{ $formatNumber($detalle->ht) }}</td>
        </tr>
        <tr>
            <td class="project">Proyecto</td>
            @foreach ($diasCabecera as $diaCabecera)
                @php $dia = $diasPorSemana->get($diaCabecera['dia_semana']); @endphp
                <td class="project center">{{ $dia?->numero_proyecto }}</td>
            @endforeach
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
</table>
</body>
</html>
