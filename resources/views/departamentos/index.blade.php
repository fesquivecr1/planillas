@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl">Departamentos</h2>


    <div class="p-6">
        <a href="{{ route('departamentos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Nuevo Departamento
        </a>

        <table class="mt-4 w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Código</th>
                    <th class="p-2">Descripción</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departamentos as $d)
                    <tr class="border-t">
                        <td class="p-2">{{ $d->CODIGO }}</td>
                        <td class="p-2">{{ $d->DESCRIPCION }}</td>
                        <td class="p-2">
                            <a href="{{ route('departamentos.edit', $d) }}" class="text-blue-600">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
