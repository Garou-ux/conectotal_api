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
$estatus = [
    ['descripcion' => 'Activo', 'activo' => 1],
    ['descripcion' => 'Inactivo', 'activo' => 1],

    // Flujo de documentos (requisiciones, cotizaciones, OC, proyectos)
    ['descripcion' => 'Borrador', 'activo' => 1],
    ['descripcion' => 'Pendiente de Autorización', 'activo' => 1],
    ['descripcion' => 'Autorizado', 'activo' => 1],
    ['descripcion' => 'Rechazado', 'activo' => 1],
    ['descripcion' => 'Cancelado', 'activo' => 1],
    ['descripcion' => 'Cerrado', 'activo' => 1],

    // Específicos de requisiciones / cotizaciones
    ['descripcion' => 'En Cotización', 'activo' => 1],
    ['descripcion' => 'Cotizado', 'activo' => 1],
    ['descripcion' => 'Ordenado', 'activo' => 1],

    // Específicos de órdenes de compra
    ['descripcion' => 'Parcialmente Recibido', 'activo' => 1],
    ['descripcion' => 'Recibido Completo', 'activo' => 1],

    // Empleados
    ['descripcion' => 'En Revisión', 'activo' => 1],
    ['descripcion' => 'Suspendido', 'activo' => 1],
    ['descripcion' => 'Baja', 'activo' => 1],

    // Proyectos
    ['descripcion' => 'En Progreso', 'activo' => 1],
    ['descripcion' => 'En Espera', 'activo' => 1],
    ['descripcion' => 'Finalizado', 'activo' => 1],

    // Stock / Almacenes
    ['descripcion' => 'Disponible', 'activo' => 1],
    ['descripcion' => 'No Disponible', 'activo' => 1],
    ['descripcion' => 'Reservado', 'activo' => 1],
    ['descripcion' => 'En Tránsito', 'activo' => 1],
    ['descripcion' => 'Dañado', 'activo' => 1],
];

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
