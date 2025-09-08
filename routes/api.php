<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Ticket\TicketsController;
use App\Http\Controllers\Api\Ticket\TicketsCategoriasController;
use App\Http\Controllers\Api\Cliente\ClientesController;
use App\Http\Controllers\Api\Plantilla\PlantillaController;
use App\Http\Controllers\Api\Productos\ProductosCategoriasController;
use App\Http\Controllers\Api\Productos\ProductosController;
use App\Http\Controllers\Api\Roles\RolesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CatAreas\CatAreasController;
use App\Http\Controllers\Api\CotizacionesProveedor\CotizacionesProveedoresController as CotizacionesProveedorCotizacionesProveedoresController;
use App\Http\Controllers\Api\Profile\PasswordController;
use App\Http\Controllers\Api\Proveedor\ProveedorController;
use App\Http\Controllers\Api\Requisiciones\RequisicionesController;
use App\Http\Controllers\CotizacionesProveedoresController;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function(){
    Route::post('/changePassword', [PasswordController::class, 'changeUserPassword']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
});


Route::middleware(['auth'])->group(function () {

    Route::prefix('tickets')->group(function () {
        Route::post('/setData', [TicketsController::class, 'setData'])->name('tickets.setData');
        Route::post('/getGridData', [TicketsController::class, 'getGridData'])->name('tickets.getGridData');
        Route::post('/getData', [TicketsController::class, 'getData'])->name('tickets.getData');
        Route::delete('/{ticket}', [TicketsController::class, 'deleteData'])->name('tickets.delete');
    });

    Route::prefix('ticketsCategoria')->group(function () {
        Route::post('/setData', [TicketsCategoriasController::class, 'setData'])->name('ticketsCategoria.setData');
        Route::post('/getGridData', [TicketsCategoriasController::class, 'getGridData'])->name('ticketsCategoria.getGridData');
        Route::post('/getData', [TicketsCategoriasController::class, 'getData'])->name('ticketsCategoria.getData');
        Route::post('/deleteData/{ticketCategoria}', [TicketsCategoriasController::class, 'deleteData'])->name('ticketsCategoria.delete');
    });

    Route::prefix('clientes')->group(function () {
        Route::post('/getDataGridParams', [ClientesController::class, 'getDataGridParams'])->name('clientes.getDataGridParams');
        Route::post('/getGridData', [ClientesController::class, 'getGridData'])->name('clientes.getGridData');
        Route::post('/getData', [ClientesController::class, 'getData'])->name('clientes.getData');
        Route::post('/setData', [ClientesController::class, 'setData'])->name('clientes.setData');
        Route::post('/deleteData', [ClientesController::class, 'deleteData'])->name('clientes.deleteData');
    });

    Route::prefix('proveedores')->group(function () {
        Route::post('/getDataGridParams', [ProveedorController::class, 'getDataGridParams'])->name('proveedores.getDataGridParams');
        Route::post('/getGridData', [ProveedorController::class, 'getGridData'])->name('proveedores.getGridData');
        Route::post('/getData', [ProveedorController::class, 'getData'])->name('proveedores.getData');
        Route::post('/setData', [ProveedorController::class, 'setData'])->name('proveedores.setData');
        Route::post('/deleteData', [ProveedorController::class, 'deleteData'])->name('proveedores.deleteData');
    });

    Route::prefix('productos')->group(function () {
        Route::post('/getDataGridParams', [ProductosController::class, 'getDataGridParams'])->name('productos.getDataGridParams');
        Route::post('/setData', [ProductosController::class, 'setData'])->name('productos.setData');
        Route::post('/getGridData', [ProductosController::class, 'getGridData'])->name('productos.getGridData');
        Route::post('/getData', [ProductosController::class, 'getData'])->name('productos.getData');
        Route::post('/deleteData', [ProductosController::class, 'deleteData'])->name('productos.deleteData');
    });

    Route::prefix('productosCategoria')->group(function () {
        Route::post('/setData', [ProductosCategoriasController::class, 'setData'])->name('productosCategoria.setData');
        Route::post('/getGridData', [ProductosCategoriasController::class, 'getGridData'])->name('productosCategoria.getGridData');
        Route::post('/getData', [ProductosCategoriasController::class, 'getData'])->name('productosCategoria.getData');
        Route::post('/deleteData', [ProductosCategoriasController::class, 'deleteData'])->name('productosCategoria.deleteData');
    });

    Route::prefix('plantillas')->group(function () {
        Route::post('/getDataGridParams', [PlantillaController::class, 'getDataGridParams'])->name('plantillas.getDataGridParams');
        Route::post('/setData', [PlantillaController::class, 'setData'])->name('plantillas.setData');
        Route::post('/getGridData', [PlantillaController::class, 'getGridData'])->name('plantillas.getGridData');
        Route::post('/getData', [PlantillaController::class, 'getData'])->name('plantillas.getData');
        Route::post('/deleteData', [PlantillaController::class, 'deleteData'])->name('plantillas.deleteData');
    });

    Route::prefix('roles')->group(function () {
        Route::post('/setData', [RolesController::class, 'setData'])->name('roles.setData');
        Route::post('/getGridData', [RolesController::class, 'getGridData'])->name('roles.getGridData');
        Route::post('/getData', [RolesController::class, 'getData'])->name('roles.getData');
        Route::post('/deleteData', [RolesController::class, 'deleteData'])->name('roles.deleteData');
    });

    Route::prefix('catAreas')->group(function () {
        Route::post('/getDataGridParams', [ProductosController::class, 'getDataGridParams'])->name('catAreas.getDataGridParams');
        Route::post('/setData', [CatAreasController::class, 'setData'])->name('catAreas.setData');
        Route::post('/getGridData', [CatAreasController::class, 'getGridData'])->name('catAreas.getGridData');
        Route::post('/getData', [CatAreasController::class, 'getData'])->name('catAreas.getData');
        Route::post('/deleteData', [CatAreasController::class, 'deleteData'])->name('catAreas.deleteData');
    });

    Route::prefix('requisiciones')->group(function () {
        Route::post('/getDataGridParams', [RequisicionesController::class, 'getDataGridParams'])->name('requisiciones.getDataGridParams');
        Route::post('/getGridData', [RequisicionesController::class, 'getGridData'])->name('requisiciones.getGridData');
        Route::post('/getData', [RequisicionesController::class, 'getData'])->name('requisiciones.getData');
        Route::post('/setData', [RequisicionesController::class, 'setData'])->name('requisiciones.setData');
        Route::post('/deleteData', [RequisicionesController::class, 'deleteData'])->name('requisiciones.deleteData');
        Route::post('/getRequisicionesForCotizacion', [RequisicionesController::class, 'getRequisicionesForCotizacion'])->name('requisiciones.getRequisicionesForCotizacion');
    });

    Route::prefix('cotizacionesProveedores')->group(function () {
        Route::post('/getDataGridParams', [CotizacionesProveedorCotizacionesProveedoresController::class, 'getDataGridParams'])->name('cotizacionesProveedores.getDataGridParams');
        Route::post('/setData', [CotizacionesProveedorCotizacionesProveedoresController::class, 'setData'])->name('cotizacionesProveedores.setData');
        Route::post('/getGridData', [CotizacionesProveedorCotizacionesProveedoresController::class, 'getGridData'])->name('cotizacionesProveedores.getGridData');
        Route::post('/getData', [CotizacionesProveedorCotizacionesProveedoresController::class, 'getData'])->name('cotizacionesProveedores.getData');
        Route::post('/deleteData', [CotizacionesProveedorCotizacionesProveedoresController::class, 'deleteData'])->name('cotizacionesProveedores.deleteData');
    });

});

