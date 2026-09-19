@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Configuración de Empresa</h2>
                <div class="row-cols-3">
                    <form method="POST" action="{{ route('configuracion.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 visually-hidden">
                            <label>ID</label>
                            <input type="number" step="1" name="id" value="{{ $setting->id }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label small fw-bold text-secondary">Nombre</label>
                            <input type="text" name="company_name" value="{{ $setting->company_name }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Cedula</label>
                            <input type="text" name="legal_id" value="{{ $setting->legal_id }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Direccion</label>
                            <input type="text" name="address" value="{{ $setting->address }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">% CCSS Empleado Regular</label>
                            <input type="number" step="0.01" name="ccss_employeeR_percentage"
                                value="{{ $setting->ccss_employeeR_percentage }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">% CCSS Empleado Pensionado</label>
                            <input type="number" step="0.01" name="ccss_employeeP_percentage"
                                value="{{ $setting->ccss_employeeP_percentage }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">% CCSS Empleado domestico</label>
                            <input type="number" step="0.01" name="ccss_domestic_percentage"
                                value="{{ $setting->ccss_domestic_percentage }}" class="form-control">
                        </div>
                        <div class="mb-3 visually-hidden">
                            <label class="form-label small fw-bold text-secondary">% CCSS Patrono</label>
                            <input type="number" step="0.01" name="ccss_employer_percentage"
                                value="{{ $setting->ccss_employer_percentage }}" class="form-control">
                        </div>

                        <button class="btn btn-success">
                            Guardar
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
