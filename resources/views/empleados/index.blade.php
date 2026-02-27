@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Empleados</h2>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            + Nuevo Empleado
        </a>
    </div>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <select name="departamento" class="form-select" onchange="this.form.submit()">
                <option value="">Todos los departamentos</option>
                @foreach ($departamentos as $d)
                    <option value="{{ $d->CODIGO }}" @selected(request('departamento') == $d->CODIGO)>
                        {{ $d->DESCRIPCION }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <table class="table table-bordered table-hover table-sm">
        <thead class="table-light">
            <tr>
                <th>Empleado</th>
                <th>Departamento</th>
                <th>Salario</th>
                <th width="120">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $e)
                <tr>
                    <td>{{ $e->APELLIDO }}, {{ $e->NOMBRE }}</td>
                    <td>{{ $e->departamento->DESCRIPCION ?? '' }}</td>
                    <td class="text-end">{{ number_format($e->SALARIOACTUAL, 2) }}</td>
                    <td>
                        <a href="{{ route('empleados.edit', $e) }}" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
