@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>
            Aguinaldo - {{ $empleado->NOMBRE }} {{ $empleado->APELLIDO }}
            ({{ $anio }})
        </h4>

        <form method="POST" action="{{ route('reportes.aguinaldo.empleado.pdf') }}" target="_blank">
            @csrf
            <input type="hidden" name="empleado_id" value="{{ $empleado->CODIGO }}">
            <input type="hidden" name="anio" value="{{ $anio }}">

            <button class="btn btn-danger mb-3">
                Exportar PDF
            </button>
        </form>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th class="text-end">Monto Bruto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mensual as $row)
                    <tr>
                        <td>{{ sprintf('%02d', $row->mes) }}/{{ $row->anio }}</td>
                        <td class="text-end">
                            {{ number_format($row->total_mes, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th class="text-end">{{ number_format($total, 2) }}</th>
                </tr>
                <tr>
                    <th>Aguinaldo</th>
                    <th class="text-end">{{ number_format($aguinaldo, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
