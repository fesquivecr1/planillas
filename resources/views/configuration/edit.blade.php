@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h2>Configuración de Empresa</h2>
        <div class="row-cols-3">
            <form method="POST" action="{{ route('configuracion.update') }}">
                @csrf
                @method('PUT')
                <div class="mb-3 visually-hidden">
                    <label>ID</label>
                    <input type="number" step="1" name="id" value="{{ $setting->id }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="company_name" value="{{ $setting->company_name }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Cedula</label>
                    <input type="text" name="legal_id" value="{{ $setting->legal_id }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Direccion</label>
                    <input type="text" name="address" value="{{ $setting->address }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>% CCSS Empleado Regular</label>
                    <input type="number" step="0.01" name="ccss_employeeR_percentage"
                        value="{{ $setting->ccss_employeeR_percentage }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>% CCSS Empleado Pensionado</label>
                    <input type="number" step="0.01" name="ccss_employeeP_percentage"
                        value="{{ $setting->ccss_employeeP_percentage }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>% CCSS Empleado domestico</label>
                    <input type="number" step="0.01" name="ccss_domestic_percentage"
                        value="{{ $setting->ccss_domestic_percentage }}" class="form-control">
                </div>
                <div class="mb-3 visually-hidden">
                    <label>% CCSS Patrono</label>
                    <input type="number" step="0.01" name="ccss_employer_percentage"
                        value="{{ $setting->ccss_employer_percentage }}" class="form-control">
                </div>

                <button class="btn btn-success">
                    Guardar
                </button>

            </form>
        </div>

    </div>
@endsection
