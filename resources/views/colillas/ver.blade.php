@extends('layouts.app')

@section('content')
    <div class="container">

        <h4>Colilla de Pago</h4>
        <hr>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Empleado:</strong>
                {{ $empleado->NOMBRE }} {{ $empleado->APELLIDO }}<br>
                <strong>Cédula:</strong> {{ $empleado->CEDULA }}<br>
                <strong>Puesto:</strong> {{ $empleado->PUESTO }}
            </div>

            <div class="col-md-6">
                <strong>Fecha:</strong> {{ $salario->FECHA }}<br>
                <strong>Departamento:</strong> {{ $salario->DEPARTAMENTO }}<br>
            </div>
        </div>

        <table class="table table-sm table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Concepto</th>
                    <th class="text-end">Monto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Salario Bruto</td>
                    <td class="text-end">{{ number_format($salario->MONTOBRUTO, 2) }}</td>
                </tr>

                @foreach ($deducciones as $d)
                    <tr>
                        <td>{{ $d->DESCRIPCION }}</td>
                        <td class="text-end">- {{ number_format($d->MONTO, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot class="table-secondary">
                <tr>
                    <th>Total Deducciones</th>
                    <th class="text-end">
                        {{ number_format($salario->DEDUCCIONES, 2) }}
                    </th>
                </tr>
                <tr>
                    <th>Neto a Pagar</th>
                    <th class="text-end">
                        {{ number_format($neto, 2) }}
                    </th>
                </tr>
            </tfoot>
        </table>

    </div>
@endsection
