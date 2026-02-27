@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4">Editar usuario</h2>

        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $usuario->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="role_id" class="form-select" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $usuario->roles->first()?->id == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <h5>Cambiar contraseña (opcional)</h5>

                    <div class="mb-3">
                        <label class="form-label">Nueva contraseña</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">
                        Actualizar
                    </button>

                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                </form>

            </div>
        </div>

    </div>
@endsection
