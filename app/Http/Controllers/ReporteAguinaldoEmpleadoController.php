<?php

namespace App\Http\Controllers;

use App\Mail\AguinaldoMail;
use App\Models\Empleado;
use App\Models\Salario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReporteAguinaldoEmpleadoController extends Controller
{
    public function index()
    {
        return view('reportes.aguinaldo.empleado_form');
    }

    public function generar(Request $request)
    {
        $request->validate([
            'anio' => 'required|integer|min:2000',
            'empleado_id' => 'required|integer',
        ]);

        $anio = $request->anio;
        $empleado = Empleado::findOrFail($request->empleado_id);

        $inicio = ($anio - 1).'-12-01';
        $fin = $anio.'-11-30';

        $mensual = Salario::query()
            ->where('EMPLEADO', $empleado->CODIGO)
            ->whereBetween('FECHA', [$inicio, $fin])
            ->selectRaw('
                YEAR(FECHA) as anio,
                MONTH(FECHA) as mes,
                SUM(MONTOBRUTO) as total_mes
            ')
            ->groupBy('anio', 'mes')
            ->orderBy('anio')
            ->orderBy('mes')
            ->get();

        $total = $mensual->sum('total_mes');
        $aguinaldo = $total / 12;

        return view(
            'reportes.aguinaldo.empleado_resultado',
            compact('empleado', 'mensual', 'total', 'aguinaldo', 'anio')
        );
    }

    public function pdf(Request $request)
    {
        $anio = $request->anio;
        $empleado = Empleado::findOrFail($request->empleado_id);

        $inicio = ($anio - 1).'-12-01';
        $fin = $anio.'-11-30';
        // dd($request->all());
        $mensual = Salario::query()
            ->where('EMPLEADO', $empleado->CODIGO)
            ->whereBetween('FECHA', [$inicio, $fin])
            ->selectRaw('
                YEAR(FECHA) as anio,
                MONTH(FECHA) as mes,
                SUM(MONTOBRUTO) as total_mes
            ')
            ->groupBy('anio', 'mes')
            ->orderBy('anio')
            ->orderBy('mes')
            ->get();

        $total = $mensual->sum('total_mes');
        $aguinaldo = $total / 12;
        $PDF = Pdf::loadView(
            'reportes.aguinaldo.empleado_pdf',
            compact('empleado', 'mensual', 'total', 'aguinaldo', 'anio')
        );
        if ($request->Selradio === 'PDF') {
            return Pdf::loadView(
                'reportes.aguinaldo.empleado_pdf',
                compact('empleado', 'mensual', 'total', 'aguinaldo', 'anio')
            )->setPaper('A4', 'portrait')
                ->stream("aguinaldo_{$empleado->CODIGO}_{$anio}.pdf");
        } else {
            Mail::to($empleado->CORREOELECTRONICO)->send(new AguinaldoMail($empleado, $PDF));

            return view('dashboard')->with('success', 'Colilla enviada correctamente');
        }

    }
}
