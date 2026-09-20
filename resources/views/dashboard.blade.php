@extends('layouts.app')
@section('content')
    <style>
        .card-hover {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            /* Eleva la tarjeta 5 pixeles */
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15) !important;
            /* Intensifica la sombra */
        }
    </style>
    @auth
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('rrhh'))
            <div class="row mb-5">
                <div class="col-12 col-md-8">
                    <h1 class="fw-bold text-dark display-5">Panel de Control</h1>
                    <p class="text-secondary fs-5">Bienvenido de nuevo. Selecciona una opción para comenzar a trabajar.</p>
                </div>
            </div>
            <div class="row g-4">

                <!-- TARJETA 1: Usuarios (Azul) -->
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Usamos h-100 para que todas midan lo mismo y text-decoration-none para quitar el subrayado -->
                    <a href="{{ route('usuarios.index') }}" class="text-decoration-none">
                        <!-- card-hover no requiere CSS, la tarjeta usa shadow-sm border rounded-4 nativos -->
                        <div class="card h-100 border border-light-subtle rounded-4 shadow-sm p-2 transition card-hover">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <!-- Icono contenido en un badge o caja usando bg-primary-subtle y p-3 -->
                                    <div class="p-3 bg-primary-subtle text-primary rounded-3 me-3 d-flex align-items-center justify-content-center"
                                        style="width: 56px; height: 56px;">
                                        <i class="bi bi-people-fill fs-3"></i>
                                    </div>
                                    <h4 class="card-title mb-0 fw-bold text-dark">Usuarios</h4>
                                </div>
                                <p class="card-text text-secondary small mb-0">Gestión completa de cuentas, roles y permisos
                                    del sistema.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- TARJETA 2: Formularios (Verde) -->
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('planillas.index') }}" class="text-decoration-none">
                        <div class="card h-100 border border-light-subtle rounded-4 shadow-sm p-2 card-hover">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="p-3 bg-success-subtle text-success rounded-3 me-3 d-flex align-items-center justify-content-center"
                                        style="width: 56px; height: 56px;">
                                        <i class="bi bi-file-earmark-text-fill fs-3"></i>
                                    </div>
                                    <h4 class="card-title mb-0 fw-bold text-dark">Ingreso de planillas</h4>
                                </div>
                                <p class="card-text text-secondary small mb-0">Ingresar, cambiar y gestionar registros de
                                    planillas
                                    .</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- TARJETA 3: Reportes (Púrpura / Indigo) -->
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('departamentos.index') }}" class="text-decoration-none">
                        <div class="card h-100 border border-light-subtle rounded-4 shadow-sm p-2 card-hover">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="p-3 bg-info-subtle text-info-emphasis rounded-3 me-3 d-flex align-items-center justify-content-center"
                                        style="width: 56px; height: 56px;">
                                        <i class="bi bi-bar-chart-line-fill fs-3"></i>
                                    </div>
                                    <h4 class="card-title mb-0 fw-bold text-dark">Departamentos</h4>
                                </div>
                                <p class="card-text text-secondary small mb-0">Visualiza el listado de departamentos para su
                                    mantenimiento.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- TARJETA 4: Reportes (Púrpura / Indigo) -->
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('empleados.index') }}" class="text-decoration-none">
                        <div class="card h-100 border border-light-subtle rounded-4 shadow-sm p-2 card-hover">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="p-3 bg-warning-subtle text-warning-emphasis rounded-3 me-3 d-flex align-items-center justify-content-center"
                                        style="width: 56px; height: 56px;">
                                        <i class="bi bi-person-rolodex fs-3"></i>
                                    </div>
                                    <h4 class="card-title mb-0 fw-bold text-dark">Empleados</h4>
                                </div>
                                <p class="card-text text-secondary small mb-0">Visualiza el listado de empleados para
                                    su
                                    mantenimiento.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- TARJETA 5: Configuracion (Púrpura / Indigo) -->
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('configuracion.edit') }}" class="text-decoration-none">
                        <div class="card h-100 border border-light-subtle rounded-4 shadow-sm p-2 card-hover">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="p-3 bg-danger-subtle text-danger-emphasis rounded-3 me-3 d-flex align-items-center justify-content-center"
                                        style="width: 56px; height: 56px;">
                                        <i class="bi bi-database-fill-gear fs-3"></i>
                                    </div>
                                    <h4 class="card-title mb-0 fw-bold text-dark">Configuracion</h4>
                                </div>
                                <p class="card-text text-secondary small mb-0">Actualizar parámetros de configuración del
                                    sistema.</p>
                            </div>
                        </div>
                    </a>
                </div>


            </div> <!-- fin de linea de navegacion -->
        @endif
    @endauth
@endsection
