<?php

namespace App\Services;

use App\Models\Empleado;

class PlanillaCalculator
{
    // const CCSS_PORCENTAJE = 0.1083;

    const HORAS_BASE = 48;

    public function calcular(
        int $empleadoId,
        float $horas,
        float $extras,
        float $incentivo,
        array $rebajosUsuario = []
    ): array {

        $empleado = Empleado::findOrFail($empleadoId);
        $valorHora = $empleado->SALARIOACTUAL / self::HORAS_BASE;
        $montoBruto = ($horas + ($extras * 1.5)) * $valorHora + $incentivo;
        $company = app('company');
        if ($empleado->TIPO) {
            $ccss_percent = $company->ccss_employeeP_percentage / 100;
        } else {
            $ccss_percent = $company->ccss_employeeR_percentage / 100;
        }

        // 🔹 CCSS SIEMPRE SE AGREGA
        $rebajoCCSS = [
            'descripcion' => 'CCSS',
            'monto' => round($montoBruto * $ccss_percent, 2),
            'tipo' => 'PORCENTAJE',
        ];
        // dd($rebajosUsuario);
        // 🔹 Normalizamos rebajos del usuario
        $rebajosUsuario = collect($rebajosUsuario)
            ->filter(fn ($r) => (! empty($r['descripcion'])) && $r['descripcion'] !== 'CCSS')
            ->values()
            ->toArray();

        // 🔹 Rebajos finales
        // dd($rebajosUsuario);
        $rebajosFinales = array_merge([$rebajoCCSS], $rebajosUsuario);

        $totalDeducciones = collect($rebajosFinales)->sum('monto');

        return [
            'empleado' => $empleado,
            'monto_bruto' => round($montoBruto, 2),
            'deducciones' => round($totalDeducciones, 2),
            'rebajos' => $rebajosFinales,
        ];
    }
}
