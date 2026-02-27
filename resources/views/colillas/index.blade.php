@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Colilla de Pago</h3>

        <form method="POST" action="{{ route('colillas.ver') }}">
            @csrf

            <div class="row mb-3">
                <div class="col-md-5">
                    <label>Empleado</label>
                    <select name="empleado" class="form-control" required>
                        @foreach ($empleados as $e)
                            <option value="{{ $e->CODIGO }}">
                                {{ $e->APELLIDO }}, {{ $e->NOMBRE }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Fecha de Planilla</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-primary w-100">
                        Ver Colilla
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
