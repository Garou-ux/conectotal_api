<?php

namespace App\Http\Controllers;

use App\Customs\Services\PDFService;

class InvoiceController extends Controller
{
    protected PDFService $pdfService;

    public function __construct(PDFService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function invoice()
    {
        $data = [
            'cliente' => [
                'nombre' => 'Juan Pérez',
                'direccion' => 'Av. Reforma 123, CDMX',
                'email' => 'juan.perez@example.com',
            ],
            'productos' => [
                ['nombre' => 'Laptop Dell XPS 13', 'cantidad' => 1, 'precio' => 22000],
                ['nombre' => 'Mouse Logitech MX Master 3', 'cantidad' => 2, 'precio' => 1800],
                ['nombre' => 'Monitor LG Ultrawide 34"', 'cantidad' => 1, 'precio' => 9500],
            ],
            'invoice' => [
                'numero' => 'INV-1001',
                'fecha' => now()->format('d/m/Y'),
                'subtotal' => 35100,
                'iva' => 5616,
                'total' => 40716,
            ]
        ];

        return $this->pdfService->generate('pdf.invoice', $data, 'invoice.pdf');
    }
}
