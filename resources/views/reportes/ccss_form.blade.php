@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Reporte CCSS</h3>

        <form method="POST" action="{{ route('reportes.ccss.generar') }}">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <label>Mes</label>
                    <select name="mes" class="form-control" required>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ $m }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Año</label>
                    <input type="number" name="anio" class="form-control" value="{{ now()->year }}" required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary w-100">
                        Generar Reporte
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
