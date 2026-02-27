<?php

use App\Http\Controllers\ColillaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteAguinaldoController;
use App\Http\Controllers\ReporteAguinaldoEmpleadoController;
use App\Http\Controllers\ReporteCCSSController;
use App\Http\Controllers\ReportePlanillaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,rrhh'])->group(function () {
    Route::resource('departamentos', DepartamentoController::class)
        ->except(['show', 'destroy']);
    Route::resource('empleados', EmpleadoController::class);
    Route::get('planillas', [PlanillaController::class, 'index'])->name('planillas.index');
    Route::post('planillas/preview', [PlanillaController::class, 'preview'])->name('planillas.preview');
    Route::post('planillas/store', [PlanillaController::class, 'store'])->name('planillas.store');
    Route::get('/reportes/planilla', [ReportePlanillaController::class, 'index'])
        ->name('reportes.planilla');
    Route::post('/reportes/planilla', [ReportePlanillaController::class, 'generar'])
        ->name('reportes.planilla.generar');

    Route::get('/reportes/ccss', [ReporteCCSSController::class, 'form'])
        ->name('reportes.ccss.form');
    Route::post('/reportes/ccss', [ReporteCCSSController::class, 'generar'])
        ->name('reportes.ccss.generar');
    Route::post('/reportes/ccss/pdf', [ReporteCCSSController::class, 'pdf'])
        ->name('reportes.ccss.pdf');

    Route::get(
        '/reportes/aguinaldo',
        [ReporteAguinaldoController::class, 'index']
    )->name('reportes.aguinaldo');

    Route::post(
        '/reportes/aguinaldo/generar',
        [ReporteAguinaldoController::class, 'generar']
    )->name('reportes.aguinaldo.generar');

    Route::post(
        '/reportes/aguinaldo/pdf',
        [ReporteAguinaldoController::class, 'pdf']
    )->name('reportes.aguinaldo.pdf');

});
Route::middleware(['auth'])->group(function () {

    // Admin / RRHH
    Route::get('/colillas', [ColillaController::class, 'index'])
        ->middleware('role:admin,rrhh')->name('colillas.index');
    Route::get('/colillas/{salario}/pdf', [ColillaController::class, 'pdf'])->name('colillas.pdf');
    Route::get('/colillas/{salario}/email', [ColillaController::class, 'email'])->name('colillas.email');
    Route::post('/colillas/ver', [ColillaController::class, 'ver'])
        ->middleware('role:admin,rrhh')
        ->name('colillas.ver');

    // Empleado (solo su colilla)
    Route::get('/mi-colilla/{salario}', [ColillaController::class, 'miColilla'])
        ->middleware('role:empleado')
        ->name('colillas.mi');
    Route::get('/reportes/aguinaldo/empleado', [ReporteAguinaldoEmpleadoController::class, 'index'])->middleware('role:empleado,admin')->name('reportes.aguinaldo.empleado');

    Route::post('/reportes/aguinaldo/empleado/generar',
        [ReporteAguinaldoEmpleadoController::class, 'generar']
    )->middleware('role:empleado,admin')->name('reportes.aguinaldo.empleado.generar');

    Route::post(
        '/reportes/aguinaldo/empleado/pdf',
        [ReporteAguinaldoEmpleadoController::class, 'pdf']
    )->middleware('role:empleado,admin')->name('reportes.aguinaldo.empleado.pdf');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

        Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('usuarios.update');

    });

});

require __DIR__.'/auth.php';
