<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteCCSSController extends Controller
{
    public function form()
    {
        return view('reportes.ccss_form');
    }

    public function generar(Request $request)
    {
        $request->validate([
            'mes' => 'required|integer|min:1|max:12',
            'anio' => 'required|integer|min:2000',
        ]);

        $mes = $request->mes;
        $anio = $request->anio;

        $datos = Salario::query()
            ->join('empleados', 'empleados.CODIGO', '=', 'salarios.EMPLEADO')
            ->leftJoin('deducciones', function ($join) {
                $join->on('deducciones.SALARIO', '=', 'salarios.CONSECUTIVO')
                    ->where('deducciones.DESCRIPCION', 'CCSS');
            })
            ->whereMonth('salarios.FECHA', $mes)
            ->whereYear('salarios.FECHA', $anio)
            ->groupBy(
                'empleados.CODIGO',
                'empleados.NOMBRE',
                'empleados.APELLIDO'
            )
            ->select([
                'empleados.CODIGO',
                DB::raw("CONCAT(empleados.NOMBRE,' ',empleados.APELLIDO) AS empleado"),
                DB::raw('SUM(salarios.MONTOBRUTO) AS total_ingresos'),
                DB::raw('SUM(IFNULL(deducciones.MONTO,0)) AS total_ccss'),
            ])
            ->orderBy('empleado')
            ->get();

        return view('reportes.ccss_resultado', compact(
            'datos',
            'mes',
            'anio'
        ));
    }

    public function pdf(Request $request)
    {
        $request->validate([
            'mes' => 'required|integer|min:1|max:12',
            'anio' => 'required|integer|min:2000',
        ]);

        $mes = $request->mes;
        $anio = $request->anio;

        $datos = Salario::query()
            ->join('empleados', 'empleados.CODIGO', '=', 'salarios.EMPLEADO')
            ->leftJoin('deducciones', function ($join) {
                $join->on('deducciones.SALARIO', '=', 'salarios.CONSECUTIVO')
                    ->where('deducciones.DESCRIPCION', 'CCSS');
            })
            ->whereMonth('salarios.FECHA', $mes)
            ->whereYear('salarios.FECHA', $anio)
            ->groupBy(
                'empleados.CODIGO',
                'empleados.NOMBRE',
                'empleados.APELLIDO'
            )
            ->select([
                DB::raw("CONCAT(empleados.NOMBRE,' ',empleados.APELLIDO) AS empleado"),
                DB::raw('SUM(salarios.MONTOBRUTO) AS total_ingresos'),
                DB::raw('SUM(IFNULL(deducciones.MONTO,0)) AS total_ccss'),
            ])
            ->orderBy('empleado')
            ->get();

        return Pdf::loadView(
            'reportes.ccss_pdf',
            compact('datos', 'mes', 'anio')
        )
            ->setPaper('A4', 'portrait')
            ->stream("reporte_ccss_{$mes}_{$anio}.pdf");
    }
}
