<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Colilla de Pago</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        h3,
        h4 {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <h3>Colilla de Pago</h3>

    <p>
        <strong>Empleado:</strong> {{ $salario->empleado->NOMBRE }} {{ $salario->empleado->APELLIDO }}<br>
        <strong>Departamento:</strong> {{ $salario->empleado->departamento->DESCRIPCION }}<br>
        <strong>Fecha:</strong> {{ $salario->FECHA }}
    </p>

    {{-- INGRESOS --}}
    <h4>Ingresos</h4>
    <table>
        <tr>
            <th>Concepto</th>
            <th>Cantidad</th>
            <th>Monto</th>
        </tr>
        <tr>
            <td>Horas ordinarias</td>
            <td>{{ $salario->HORASLABORADAS }}</td>
            <td>
                {{ number_format(($salario->HORASLABORADAS * $salario->empleado->SALARIOACTUAL) / 48, 2) }}
            </td>
        </tr>
        <tr>
            <td>Horas extra</td>
            <td>{{ $salario->HORASEXTRA }}</td>
            <td>
                {{ number_format(($salario->HORASEXTRA * 1.5 * $salario->empleado->SALARIOACTUAL) / 48, 2) }}
            </td>
        </tr>
        <tr>
            <td>Otros ingresos</td>
            <td>-</td>
            <td>{{ number_format($salario->TOTALINCENTIVO, 2) }}</td>
        </tr>
        <tr>
            <th colspan="2">Total Bruto</th>
            <th>{{ number_format($salario->MONTOBRUTO, 2) }}</th>
        </tr>
    </table>

    {{-- DEDUCCIONES --}}
    <h4>Deducciones</h4>
    <table>
        <tr>
            <th>Concepto</th>
            <th>Monto</th>
        </tr>
        @foreach ($salario->deducciones as $ded)
            <tr>
                <td>{{ $ded->DESCRIPCION }}</td>
                <td>{{ number_format($ded->MONTO, 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <th>Total Deducciones</th>
            <th>{{ number_format($salario->DEDUCCIONES, 2) }}</th>
        </tr>
    </table>

    {{-- RESUMEN --}}
    <h4>Resumen</h4>
    <table>
        <tr>
            <th>Concepto</th>
            <th>Monto</th>
        </tr>
        <tr>
            <td><strong>Salario Bruto:</strong></td>
            <td> {{ number_format($salario->MONTOBRUTO, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Total Deducciones:</strong></td>
            <td> {{ number_format($salario->DEDUCCIONES, 2) }}</td>
        </tr>
        <tr>
            <th> <strong>Salario Neto:</strong></th>
            <th>{{ number_format($salario->MONTOBRUTO - $salario->DEDUCCIONES, 2) }} </th>

        </tr>
    </table>

</body>

</html>
