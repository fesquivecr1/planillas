@extends('layouts.app')

@section('content')
    <div class="container mt-4">





        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Gestión de usuarios</h2>
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                        Crear usuario
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light text-uppercase small text-muted">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill bg-success-subtle text-success border border-success-subtle">
                                            {{ $usuario->roles->pluck('name')->implode(', ') }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning">
                                            Editar
                                        </a>
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
