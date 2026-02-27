@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Reporte General de Aguinaldo - {{ $anio }}</h4>

        <form method="POST" action="{{ route('reportes.aguinaldo.pdf') }}" target="_blank">
            @csrf
            <input type="hidden" name="anio" value="{{ $anio }}">

            <button class="btn btn-danger mb-3">
                Exportar PDF
            </button>
        </form>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Identificación</th>
                    <th class="text-end">Total Recibido</th>
                    <th class="text-end">Aguinaldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $row)
                    <tr>
                        <td>{{ $row->empleado }}</td>
                        <td>{{ $row->CEDULA }}</td>
                        <td class="text-end">
                            {{ number_format($row->total_bruto, 2) }}
                        </td>
                        <td class="text-end">
                            {{ number_format($row->aguinaldo, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
