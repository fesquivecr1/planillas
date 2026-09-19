@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class='text-center 'class="card-title mb-4">Editar Empleado</h1>

                    <form method="POST" action="{{ route('empleados.update', $empleado) }}">
                        @method('PUT')
                        @include('empleados._form')
                    </form>
            </div>
        </div>
    </div>
@endsection
