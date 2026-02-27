<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte CCSS</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
        }

        th {
            background-color: #eee;
        }

        .text-right {
            text-align: right;
        }

        h3 {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <h3>Reporte CCSS</h3>
    <p>
        <strong>Periodo:</strong>
        {{ str_pad($mes, 2, '0', STR_PAD_LEFT) }}/{{ $anio }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Empleado</th>
                <th class="text-right">Total Ingresos</th>
                <th class="text-right">CCSS Rebajado</th>
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
                    <td class="text-right">
                        {{ number_format($row->total_ingresos, 2) }}
                    </td>
                    <td class="text-right">
                        {{ number_format($row->total_ccss, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th>Totales</th>
                <th class="text-right">
                    {{ number_format($totalIngresos, 2) }}
                </th>
                <th class="text-right">
                    {{ number_format($totalCCSS, 2) }}
                </th>
            </tr>
        </tfoot>
    </table>

</body>

</html>
