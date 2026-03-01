<?php

namespace App\Http\Controllers;

use App\Mail\ColillaPagoMail;
use App\Models\Departamento;
use App\Models\Salario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReportePlanillaController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::orderBy('DESCRIPCION')->get();

        return view('reportes.planilla.index', compact('departamentos'));
    }

    public function generar(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'departamento' => 'nullable|integer',
        ]);

        $planilla = DB::table('salarios as s')
            ->join('empleados as e', 'e.CODIGO', '=', 's.EMPLEADO')
            ->join('departamentos as d', 'd.CODIGO', '=', 's.DEPARTAMENTO')
            ->where('s.FECHA', $request->fecha)
            ->when($request->departamento, function ($q) use ($request) {
                $q->where('s.DEPARTAMENTO', $request->departamento);
            })
            ->select(
                DB::raw("CONCAT(e.NOMBRE,' ',e.APELLIDO) as empleado"),
                'd.DESCRIPCION as departamento',
                's.HORASLABORADAS',
                's.HORASEXTRA',
                's.TOTALINCENTIVO',
                's.MONTOBRUTO',
                's.DEDUCCIONES',
                DB::raw('(s.MONTOBRUTO - s.DEDUCCIONES) as NETO'),
                's.CONSECUTIVO as CONSECUTIVO'
            )
            ->orderBy('empleado')
            ->get();

        if ($request->checkEmail === true) {
            foreach ($planilla as $salario) {
                $s = Salario::with([
                    'empleado',
                    'empleado.departamento',
                    'deducciones',
                ])->findOrFail($salario->CONSECUTVO);

                if (! $s->empleado->EMAIL) {
                    continue;
                }
                $PDF = Pdf::loadView('reportes.colilla', compact('s'));

                Mail::to($s->empleado->EMAIL)
                    ->queue(new ColillaPagoMail($s->empleado, $PDF));
            }
        }
        $fechaInicial = date_create($request->fecha);
        $rangoFechas = 'Del '.date_format(date_sub($fechaInicial, date_interval_create_from_date_string('6 days')), 'Y-m-d').' al '.$request->fecha;

        return view('reportes.planilla.resultado', [
            'fecha' => $rangoFechas,
            'planilla' => $planilla,
        ]);
    }
}
