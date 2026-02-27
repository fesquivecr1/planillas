@extends('layouts.app')

@section('content')
    <h2>Ingreso de Planilla</h2>

    <form method="POST" action="{{ route('planillas.preview') }}" class="row g-3">
        @csrf

        <div class="col-md-4">
            <label class="form-label">Fecha de planilla</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Departamento</label>
            <select name="departamento" class="form-select" required>
                <option value="">Seleccione</option>
                @foreach ($departamentos as $d)
                    <option value="{{ $d->CODIGO }}">{{ $d->DESCRIPCION }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 align-self-end">
            <button class="btn btn-primary">Continuar</button>
        </div>
    </form>
@endsection
