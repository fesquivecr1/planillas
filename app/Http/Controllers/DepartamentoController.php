<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::orderBy('DESCRIPCION')->get();
        return view('departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'DESCRIPCION' => 'required|string|max:45|unique:departamentos,DESCRIPCION',
        ]);

        Departamento::create($request->only('DESCRIPCION'));

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento creado correctamente');
    }

    public function edit(Departamento $departamento)
    {
        return view('departamentos.edit', compact('departamento'));
    }

    public function update(Request $request, Departamento $departamento)
    {
        $request->validate([
            'DESCRIPCION' => 'required|string|max:45|unique:departamentos,DESCRIPCION,' . $departamento->CODIGO . ',CODIGO',
        ]);

        $departamento->update($request->only('DESCRIPCION'));

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento actualizado');
    }

    // ❌ NO destroy()
}
