@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Reporte General de Aguinaldo</h4>

        <form method="POST" action="{{ route('reportes.aguinaldo.generar') }}">
            @csrf

            <div class="row">
                <div class="col-md-3">
                    <label>Año</label>
                    <input type="number" name="anio" class="form-control" value="{{ now()->year }}" required>
                </div>
            </div>

            <button class="btn btn-primary mt-3">
                Generar Reporte
            </button>
        </form>
    </div>
@endsection
