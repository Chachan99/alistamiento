<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\AlistamientoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemChecklistController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ConductorController;

// Ruta para dashboard conductor - protegida por auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ConductorController::class, 'dashboard'])->name('dashboard');
});

// Reportes
Route::middleware(['auth'])->group(function () {
    Route::get('/reportes', function () {
        return view('reportes.index');
    })->name('reportes.index');
});

// Asignación de conductor a vehículo
Route::middleware(['auth'])->group(function () {
    Route::get('/vehiculos/asignar-conductor', [VehiculoController::class, 'asignarConductor'])->name('vehiculos.asignar');
    Route::post('/vehiculos/asignar-conductor/{vehiculo}', [VehiculoController::class, 'guardarAsignacion'])->name('vehiculos.guardar-asignacion');
});

// Alistamiento conductor
Route::middleware(['auth'])->group(function () {
    Route::get('/alistamiento', [AlistamientoController::class, 'create'])->name('alistamiento.create');
    Route::post('/alistamiento', [AlistamientoController::class, 'store'])->name('alistamiento.store');
});

// Administración usuarios (prefijo admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('usuarios', UserController::class);
});

// Checklist (excepto show)
Route::middleware(['auth'])->group(function () {
    Route::resource('checklist', ItemChecklistController::class)->except(['show']);
});

// Admin dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Alistamientos para jefe operativo
Route::middleware(['auth'])->group(function () {
    Route::get('verificar-alistamientos', [AlistamientoController::class, 'verificar'])->name('alistamientos.verificar');
    Route::get('alistamiento/{id}', [AlistamientoController::class, 'detalle'])->name('alistamientos.detalle');
    Route::post('alistamiento/{id}/aprobar', [AlistamientoController::class, 'aprobar'])->name('alistamientos.aprobar');
    Route::post('alistamiento/{id}/rechazar', [AlistamientoController::class, 'rechazar'])->name('alistamientos.rechazar');
});

// Recursos vehiculos
Route::middleware(['auth'])->group(function () {
    Route::resource('vehiculos', VehiculoController::class);
});

// Ruta raíz - redirige a login
Route::get('/', function () {
    return redirect()->route('login');
});
