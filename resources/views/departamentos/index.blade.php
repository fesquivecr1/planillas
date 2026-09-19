@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl">Departamentos</h2>


    <div class="p-6">
        <a href="{{ route('departamentos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Nuevo Departamento
        </a>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <!-- table-responsive permite scroll horizontal en móviles sin romper el diseño -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 ">
                        <thead class="table-light text-uppercase small text-muted">
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
                                    <td class=" text-end pe-4">
                                        <a href="{{ route('departamentos.edit', $d) }}"
                                            class="btn btn-sm btn-warning">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
