@extends('layouts.app')

@section('content')
    <h2>Editar Departamento</h2>


    <div class="p-6">
        <form method="POST" action="{{ route('departamentos.update', $departamento) }}">
            @csrf
            @method('PUT')

            <label>Descripción</label>
            <input type="text" name="DESCRIPCION" value="{{ $departamento->DESCRIPCION }}" class="border w-full p-2"
                required>

            <button class="mt-4 bg-blue-600 text-black px-4 py-2 rounded">
                Actualizar
            </button>
        </form>
    </div>
@endsection
