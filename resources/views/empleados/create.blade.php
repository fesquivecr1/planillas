@extends('layouts.app')

@section('content')
    <h1>Nuevo Empleado</h1>

    <form method="POST" action="{{ route('empleados.store') }}">
        @include('empleados._form')
    </form>
@endsection
