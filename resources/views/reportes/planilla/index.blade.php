@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Reporte de Planilla</h3>
        <div class = "row-md-4">
            <form method="POST" action="{{ route('reportes.planilla.generar') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Fecha de Planilla</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label>Departamento</label>
                        <select name="departamento" class="form-control">
                            <option value="">-- Todos --</option>
                            @foreach ($departamentos as $d)
                                <option value="{{ $d->CODIGO }}">
                                    {{ $d->DESCRIPCION }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" name="checkEmail">
                            <label class="form-check-label" for="checkEmail">
                                Enviar Emails?
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            Generar Reporte
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
