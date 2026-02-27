<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Planillas semanales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap (si ya lo usas en el proyecto) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <main class="container d-flex flex-column justify-content-center align-items-center flex-grow-1 text-center">
        <h1 class="display-4 fw-bold mb-3">
            Planillas semanales
        </h1>

        <p class="lead mb-4">
            Sistema de gestión de planillas
        </p>

        <p class="mb-5 text-muted">
            Desarrollado por <strong>Desicon</strong> para <strong>Ferretería San Sebastián</strong>
        </p>

        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                Ir al sistema
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                Iniciar sesión
            </a>
        @endauth
    </main>

    <footer class="text-center text-muted py-3">
        © 2026 Ferretería San Sebastián
    </footer>

</body>

</html>
