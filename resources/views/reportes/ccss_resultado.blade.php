@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>
            Reporte CCSS – {{ str_pad($mes, 2, '0', STR_PAD_LEFT) }}/{{ $anio }}
        </h3>
        <form method="POST" action="{{ route('reportes.ccss.pdf') }}" target="_blank">
            @csrf
            <input type="hidden" name="mes" value="{{ $mes }}">
            <input type="hidden" name="anio" value="{{ $anio }}">

            <button class="btn btn-danger mb-3">
                Generar PDF
            </button>
        </form>
        <table class="table table-bordered table-sm mt-3">
            <thead class="table-light">
                <tr>
                    <th>Empleado</th>
                    <th class="text-end">Total Ingresos</th>
                    <th class="text-end">CCSS Rebajado</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalIngresos = 0;
                    $totalCCSS = 0;
                @endphp

                @foreach ($datos as $row)
                    @php
                        $totalIngresos += $row->total_ingresos;
                        $totalCCSS += $row->total_ccss;
                    @endphp
                    <tr>
                        <td>{{ $row->empleado }}</td>
                        <td class="text-end">
                            {{ number_format($row->total_ingresos, 2) }}
                        </td>
                        <td class="text-end">
                            {{ number_format($row->total_ccss, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot class="table-light">
                <tr>
                    <th>Totales</th>
                    <th class="text-end">
                        {{ number_format($totalIngresos, 2) }}
                    </th>
                    <th class="text-end">
                        {{ number_format($totalCCSS, 2) }}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
