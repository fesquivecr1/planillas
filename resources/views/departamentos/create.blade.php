<x-app-layout>
    <x-slot name="header">
        <h2>Nuevo Departamento</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('departamentos.store') }}">
            @csrf

            <label>Descripción</label>
            <input type="text" name="DESCRIPCION" class="border w-full p-2" required>

            <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
                Guardar
            </button>
        </form>
    </div>
</x-app-layout>
