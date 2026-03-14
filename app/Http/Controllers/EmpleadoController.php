<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:admin,rrhh');
    }

    public function index(Request $request)
    {
        $departamentos = Departamento::orderBy('DESCRIPCION')->get();

        $empleados = Empleado::with('departamento')
            ->when($request->departamento, function ($q) use ($request) {
                $q->where('DEPARTAMENTO', $request->departamento);
            })
            ->orderBy('APELLIDO')
            ->orderBy('NOMBRE')
            ->get();

        return view('empleados.index', compact('empleados', 'departamentos'));
    }

    public function create()
    {
        $departamentos = Departamento::orderBy('DESCRIPCION')->get();

        return view('empleados.create', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'CEDULA' => 'required|unique:empleados,CEDULA',
            'NOMBRE' => 'required',
            'APELLIDO' => 'required',
            'DEPARTAMENTO' => 'required|exists:departamentos,CODIGO',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado correctamente');
    }

    public function edit(Empleado $empleado)
    {
        $departamentos = Departamento::orderBy('DESCRIPCION')->get();

        return view('empleados.edit', compact('empleado', 'departamentos'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'CEDULA' => 'required|unique:empleados,CEDULA,'.$empleado->CODIGO.',CODIGO',
            'NOMBRE' => 'required',
            'APELLIDO' => 'required',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado');
    }

    public function destroy(Empleado $empleado)
    {
        // NO borrar — solo inactivar
        $empleado->update(['ESTATUS' => 0]);

        return redirect()->back()->with('success', 'Empleado inactivado');
    }
}
