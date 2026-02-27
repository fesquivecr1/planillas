@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Planilla – {{ $fecha }}</h3>

        <table class="table table-bordered table-sm">
            <thead class="table-light">
                <tr>
                    <th>Empleado</th>
                    <th>Departamento</th>
                    <th>Horas</th>
                    <th>Extras</th>
                    <th>Incentivos</th>
                    <th>Bruto</th>
                    <th>Deducciones</th>
                    <th>Neto</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalBruto = 0;
                    $totalDeducciones = 0;
                    $totalNeto = 0;
                @endphp

                @foreach ($planilla as $p)
                    @php
                        $totalBruto += $p->MONTOBRUTO;
                        $totalDeducciones += $p->DEDUCCIONES;
                        $totalNeto += $p->NETO;
                    @endphp
                    <tr>
                        <td>{{ $p->empleado }}</td>
                        <td>{{ $p->departamento }}</td>
                        <td>{{ $p->HORASLABORADAS }}</td>
                        <td>{{ $p->HORASEXTRA }}</td>
                        <td>{{ number_format($p->TOTALINCENTIVO, 2) }}</td>
                        <td>{{ number_format($p->MONTOBRUTO, 2) }}</td>
                        <td>{{ number_format($p->DEDUCCIONES, 2) }}</td>
                        <td><strong>{{ number_format($p->NETO, 2) }}</strong></td>
                        <td><a href="{{ route('colillas.pdf', [$p->CONSECUTIVO]) }}" class="btn btn-sm btn-danger"
                                target="_blank">PDF</a>
                            <a href="{{ route('colillas.email', [$p->CONSECUTIVO]) }}"
                                class="btn btn-sm btn-primary">Email</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot class="table-secondary">
                <tr>
                    <th colspan="5">Totales</th>
                    <th>{{ number_format($totalBruto, 2) }}</th>
                    <th>{{ number_format($totalDeducciones, 2) }}</th>
                    <th>{{ number_format($totalNeto, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
