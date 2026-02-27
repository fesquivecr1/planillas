<?php

namespace App\Services;

use App\Models\Salario;
use Barryvdh\DomPDF\Facade\Pdf;

class ColillaPdfService
{
    public function generar(int $empleadoId, string $fecha, int $departamento)
    {
        $salario = Salario::with(['empleado', 'deducciones'])
            ->where('EMPLEADO', $empleadoId)
            ->where('FECHA', $fecha)
            ->where('DEPARTAMENTO', $departamento)
            ->firstOrFail();

        return Pdf::loadView('pdf.colilla', compact('salario'));
    }
}
