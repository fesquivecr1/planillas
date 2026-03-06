<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Aguinaldo Empleado</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
        }

        th {
            background: #eee;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
@php
    $company = app('company');

@endphp

<body>
    <img src="{{ public_path('images/FSS_Logo.jpeg') }}" alt="Logo Empresa" style="height:80px;">
    <h3>Reporte de Aguinaldo</h3>
    <h3>{{ $company->company_name }}</h3>
    <h4>Cedula: {{ $company->legal_id }}</h4>
    <h4>
        Aguinaldo - {{ $empleado->NOMBRE }} {{ $empleado->APELLIDO }}
        {{ $empleado->CEDULA }}
        <br>
        <strong>({{ $anio }}) </strong>
    </h4>


    <div class="container">




        <table>
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Monto Bruto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mensual as $row)
                    <tr>
                        <td>{{ sprintf('%02d', $row->mes) }}/{{ $row->anio }}</td>
                        <td class="text-right">
                            {{ number_format($row->total_mes, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right">Total</th>
                    <th class="text-right">{{ number_format($total, 2) }}</th>
                </tr>
                <tr>
                    <th>Aguinaldo</th>
                    <th>{{ number_format($aguinaldo, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

</body>

</html>
