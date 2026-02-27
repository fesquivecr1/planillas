<?php

namespace App\Http\Controllers;

use App\Mail\ColillaPagoMail;
use App\Models\Empleado;
use App\Models\Salario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ColillaController extends Controller
{
    public function index()
    {
        return view('colillas.index', [
            'empleados' => Empleado::orderBy('APELLIDO')->get(),
        ]);
    }

    public function pdf($salarioId)
    {
        $salario = Salario::with([
            'empleado',
            'empleado.departamento',
            'deducciones',
        ])->findOrFail($salarioId);

        return Pdf::loadView('reportes.colilla', compact('salario'))
            ->stream('colilla_empleado_'.$salario->EMPLEADO.'.pdf');
    }

    public function email($salarioId)
    {
        $salario = Salario::with([
            'empleado',
            'empleado.departamento',
            'deducciones',
        ])->findOrFail($salarioId);
        if (! $salario->empleado->CORREOELECTRONICO) {
            return back()->with('error', 'El empleado no tiene correo registrado');
        }
        $PDF = Pdf::loadView('reportes.colilla', compact('salario'));
        Mail::to($salario->empleado->CORREOELECTRONICO)->send(new ColillaPagoMail($salario->empleado, $PDF));

        return back()->with('success', 'Colilla enviada correctamente');

    }

    public function ver(Request $request)
    {
        $request->validate([
            'empleado' => 'required|integer',
            'fecha' => 'required|date',
        ]);

        $salario = Salario::where('EMPLEADO', $request->empleado)
            ->where('FECHA', $request->fecha)
            ->firstOrFail();

        return $this->renderColilla($salario);
    }

    public function miColilla(Salario $salario)
    {
        // Seguridad: validar que el salario pertenece al usuario logueado
        if ($salario->EMPLEADO !== auth()->user()->empleado_id) {
            abort(403);
        }

        return $this->renderColilla($salario);
    }

    private function renderColilla(Salario $salario)
    {
        $empleado = Empleado::findOrFail($salario->EMPLEADO);

        $deducciones = DB::table('deducciones')
            ->where('SALARIO', $salario->CONSECUTIVO)
            ->get();

        return view('colillas.ver', [
            'empleado' => $empleado,
            'salario' => $salario,
            'deducciones' => $deducciones,
            'neto' => $salario->MONTOBRUTO - $salario->DEDUCCIONES,
        ]);
    }
}
