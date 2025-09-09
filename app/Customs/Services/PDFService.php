<?php

namespace App\Customs\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFService
{
    /**
     * Genera y descarga un PDF basado en una vista Blade.
     *
     * @param string $view   Nombre de la vista Blade (ej: 'pdf.invoice')
     * @param array  $data   Datos a enviar a la vista
     * @param string $filename Nombre del archivo PDF
     * @param bool   $stream  true = mostrar en navegador, false = descargar
     * @return \Illuminate\Http\Response
     */
    public function generate(string $view, array $data = [], string $filename = 'document.pdf', bool $stream = false)
    {
        $pdf = Pdf::loadView($view, $data);

        if ($stream) {
            return $pdf->stream($filename);
        }

        return $pdf->download($filename);
    }
}
