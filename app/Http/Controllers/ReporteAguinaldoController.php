<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteAguinaldoController extends Controller
{
    public function index()
    {
        return view('reportes.aguinaldo_form');
    }

    public function generar(Request $request)
    {
        $request->validate([
            'anio' => 'required|integer|min:2000',
        ]);

        $anio = $request->anio;

        $inicio = ($anio - 1).'-12-01';
        $fin = $anio.'-11-30';

        $datos = Salario::query()
            ->join('empleados', 'empleados.CODIGO', '=', 'salarios.EMPLEADO')
            ->whereBetween('salarios.FECHA', [$inicio, $fin])
            ->groupBy(
                'empleados.CODIGO',
                'empleados.NOMBRE',
                'empleados.APELLIDO',
                'empleados.CEDULA'
            )
            ->select([
                DB::raw("CONCAT(empleados.NOMBRE,' ',empleados.APELLIDO) AS empleado"),
                'empleados.CEDULA',
                DB::raw('SUM(salarios.MONTOBRUTO) AS total_bruto'),
                DB::raw('SUM(salarios.MONTOBRUTO) / 12 AS aguinaldo'),
            ])
            ->orderBy('empleado')
            ->get();

        return view(
            'reportes.aguinaldo_resultado',
            compact('datos', 'anio')
        );
    }

    public function pdf(Request $request)
    {
        $anio = $request->anio;

        $inicio = ($anio - 1).'-12-01';
        $fin = $anio.'-11-30';

        $datos = Salario::query()
            ->join('empleados', 'empleados.CODIGO', '=', 'salarios.EMPLEADO')
            ->whereBetween('salarios.FECHA', [$inicio, $fin])
            ->groupBy(
                'empleados.CODIGO',
                'empleados.NOMBRE',
                'empleados.APELLIDO',
                'empleados.CEDULA'
            )
            ->select([
                DB::raw("CONCAT(empleados.NOMBRE,' ',empleados.APELLIDO) AS empleado"),
                'empleados.CEDULA',
                DB::raw('SUM(salarios.MONTOBRUTO) AS total_bruto'),
                DB::raw('SUM(salarios.MONTOBRUTO) / 12 AS aguinaldo'),
            ])
            ->orderBy('empleado')
            ->get();

        return Pdf::loadView(
            'reportes.aguinaldo_pdf',
            compact('datos', 'anio')
        )
            ->setPaper('A4', 'portrait')
            ->stream("aguinaldo_general_{$anio}.pdf");
    }
}
