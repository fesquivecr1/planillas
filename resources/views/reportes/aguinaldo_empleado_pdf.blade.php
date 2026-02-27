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

<body>



    <div class="container">
        <h4>
            Aguinaldo - {{ $empleado->NOMBRE }} {{ $empleado->APELLIDO }}
            ({{ $anio }})
        </h4>


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
                        <td class="text-end">
                            {{ number_format($row->total_mes, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ number_format($total, 2) }}</th>
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
