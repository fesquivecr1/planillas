@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Aguinaldo por Empleado</h4>

        <form method="POST" action="{{ route('reportes.aguinaldo.empleado.generar') }}">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <label>Empleado</label>
                    <select name="empleado_id" class="form-control" required>
                        @foreach (\App\Models\Empleado::orderBy('NOMBRE')->get() as $emp)
                            <option value="{{ $emp->CODIGO }}">
                                {{ $emp->NOMBRE }} {{ $emp->APELLIDO }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Año</label>
                    <input type="number" name="anio" class="form-control" value="{{ now()->year }}" required>
                </div>
            </div>

            <button class="btn btn-primary mt-3">
                Generar
            </button>
        </form>
    </div>
@endsection
