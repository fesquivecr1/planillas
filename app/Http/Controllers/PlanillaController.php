<?php

namespace App\Http\Controllers;

use App\Models\Deduccion;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Salario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::orderBy('DESCRIPCION')->get();

        return view('planillas.index', compact('departamentos'));
    }

    public function store(Request $request)
    {
        // dd('ENTRO AL STORE', $request->all());

        DB::transaction(function () use ($request) {
            $calculator = app(\App\Services\PlanillaCalculator::class);
            foreach ($request->empleados as $empleadoId => $data) {

                // Buscar o crear salario
                $salario = Salario::firstOrCreate(
                    [
                        'EMPLEADO' => $empleadoId,
                        'FECHA' => $request->fecha,
                        'DEPARTAMENTO' => $request->departamento,
                    ],
                    [
                        'HORASLABORADAS' => 0,
                        'HORASEXTRA' => 0,
                        'TOTALINCENTIVO' => 0,
                    ]
                );

                // 🔐 Actualizar SOLO si vienen datos
                $resultado = $calculator->calcular(
                    $empleadoId,
                    $data['horas'] ?? $salario->HORASLABORADAS,
                    $data['extras'] ?? $salario->HORASEXTRA,
                    $data['otros'] ?? $salario->TOTALINCENTIVO,
                    $data['rebajos'] ?? []
                );

                $salario->update([
                    'HORASLABORADAS' => $data['horas'] ?? $salario->HORASLABORADAS,
                    'HORASEXTRA' => $data['extras'] ?? $salario->HORASEXTRA,
                    'TOTALINCENTIVO' => $data['otros'] ?? $salario->TOTALINCENTIVO,
                    'MONTOBRUTO' => $resultado['monto_bruto'],
                    'DEDUCCIONES' => $resultado['deducciones'],

                ]);

                // 🧹 Limpiar deducciones previas del salario
                $salario->deducciones()->delete();

                // 💸 Guardar rebajos

                foreach ($resultado['rebajos'] as $rebajo) {

                    if (empty($rebajo['descripcion']) || empty($rebajo['monto'])) {
                        continue;
                    }

                    Deduccion::create([
                        'SALARIO' => $salario->CONSECUTIVO,
                        'DESCRIPCION' => $rebajo['descripcion'],
                        'MONTO' => $rebajo['monto'],
                        'TIPO' => 1,
                    ]);
                }

            }
        });

        return redirect()
            ->route('planillas.index')
            ->with('success', 'Planilla procesada correctamente ✅');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'departamento' => 'required',
        ]);

        $departamento = Departamento::findOrFail($request->departamento);
        $empleados = Empleado::where('DEPARTAMENTO', $departamento->CODIGO)
            ->where('ESTATUS', 1)
            ->orderBy('APELLIDO')
            ->orderBy('NOMBRE')
            ->get();
        // Buscar salarios existentes para esta planilla

        $salarios = Salario::with('deducciones')
            ->where('FECHA', $request->fecha)
            ->where('DEPARTAMENTO', $request->departamento)
            ->get()
            ->keyBy('EMPLEADO');   // <<<<<< CLAVE

        // dd('Salarios', $salarios->toArray());
        // Empleados activos del departamento

        $empleadosData = [];

        foreach ($empleados as $emp) {

            $salario = $salarios[$emp->CODIGO] ?? null;

            $rebajos = [];

            if ($salario) {
                foreach ($salario->deducciones as $i => $ded) {
                    $rebajos[$i] = [
                        'descripcion' => $ded->DESCRIPCION,
                        'monto' => $ded->MONTO,
                    ];
                }
            }

            $empleadosData[$emp->CODIGO] = [
                'horas' => $salario->HORASLABORADAS ?? 0,
                'extras' => $salario->HORASEXTRA ?? 0,
                'otros' => $salario->TOTALINCENTIVO ?? 0,
                'rebajos' => $rebajos,
            ];
        }

        // dd('EmpleadosData data:', $empleadosData);
        return view('planillas.preview', [
            'fecha' => $request->fecha,
            'departamento' => $departamento,
            'empleados' => $empleados,
            'empleadosData' => $empleadosData,
            'planillaExiste' => $salarios->count() > 0,
        ]);
    }
}
