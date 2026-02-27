<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Aguinaldo General</title>
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

    <h3>Reporte General de Aguinaldo</h3>
    <p><strong>Año:</strong> {{ $anio }}</p>

    <table>
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Identificación</th>
                <th class="text-right">Total Recibido</th>
                <th class="text-right">Aguinaldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $row)
                <tr>
                    <td>{{ $row->empleado }}</td>
                    <td>{{ $row->CEDULA }}</td>
                    <td class="text-right">
                        {{ number_format($row->total_bruto, 2) }}
                    </td>
                    <td class="text-right">
                        {{ number_format($row->aguinaldo, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
