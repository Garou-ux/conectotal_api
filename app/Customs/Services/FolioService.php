<?php

namespace App\Customs\Services;

use App\Models\Folio;

class FolioService {

public static function generarFolio($serie)
{
    $mes = now()->format('m');
    $anio = now()->format('Y');

    $last = Folio::where('serie', $serie)
        ->where('mes', $mes)
        ->where('anio', $anio)
        ->orderByDesc('consecutivo')
        ->first();

    $nextConsecutivo = $last ? $last->consecutivo + 1 : 1;

    $folio = sprintf("%s-%s-%s-%04d", $serie, $mes, $anio, $nextConsecutivo);

    return Folio::create([
        'serie' => $serie,
        'mes' => $mes,
        'anio' => $anio,
        'consecutivo' => $nextConsecutivo,
        'folio' => $folio,
    ])->folio;
}


}
