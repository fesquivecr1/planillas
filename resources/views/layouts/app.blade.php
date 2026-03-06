<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Planillas</title>

    <!-- Bootstrap CDN (simple y rápido) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Planillas</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @auth
                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('rrhh'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('departamentos.index') }}">Departamentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('empleados.index') }}">Empleados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('configuracion.edit') }}">Configuracion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('planillas.index') }}">Ingreso de Planilla</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    Reportes
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('reportes.planilla') }}">Planillas</a></li>
                                    <li><a class="dropdown-item" href="{{ route('reportes.aguinaldo') }}">Aguinaldos</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('reportes.aguinaldo.empleado') }}">Aguinaldos por empleado</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('reportes.ccss.form') }}">CCSS</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth

                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="navbar-text me-3">
                                {{ auth()->user()->name }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-light">Salir</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        {{-- Mensajes --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Contenido --}}
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
