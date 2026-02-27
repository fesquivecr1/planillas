@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class='text-center'>Editar Empleado</h1>

        <form method="POST" action="{{ route('empleados.update', $empleado) }}">
            @method('PUT')
            @include('empleados._form')
        </form>
    </div>
@endsection
