@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h4 class="mb-3">
            Planilla – {{ $fecha }} | Departamento {{ $departamento['DESCRIPCION'] }}
        </h4>

        @if ($planillaExiste)
            <div class="alert alert-info">
                Esta planilla ya existe. Los datos fueron cargados para edición.
            </div>
        @endif

        <form method="POST" action="{{ route('planillas.store') }}">
            @csrf

            <input type="hidden" name="fecha" value="{{ $fecha }}">
            <input type="hidden" name="departamento" value="{{ $departamento['CODIGO'] }}">

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Empleado</th>
                            <th>Horas</th>
                            <th>Extras</th>
                            <th>Otros</th>
                            <th>Rebajo 1</th>
                            <th>Rebajo 2</th>
                            <th>Rebajo 3</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($empleados as $emp)
                            @php
                                $empId = $emp->CODIGO;
                                $data = $empleadosData[$empId];
                            @endphp

                            <tr>
                                {{-- Empleado --}}
                                <td>
                                    {{ $emp->APELLIDO }}, {{ $emp->NOMBRE }}
                                </td>

                                {{-- Horas --}}
                                <td>
                                    <input type="number" step="0.01" name="empleados[{{ $empId }}][horas]"
                                        value="{{ $data['horas'] }}" class="form-control form-control-sm">
                                </td>

                                {{-- Extras --}}
                                <td>
                                    <input type="number" step="0.01" name="empleados[{{ $empId }}][extras]"
                                        value="{{ $data['extras'] }}" class="form-control form-control-sm">
                                </td>

                                {{-- Otros --}}
                                <td>
                                    <input type="number" step="0.01" name="empleados[{{ $empId }}][otros]"
                                        value="{{ $data['otros'] }}" class="form-control form-control-sm">
                                </td>

                                {{-- Rebajo 1 --}}
                                <td>
                                    <input type="text" class="form-control form-control-sm mb-1"
                                        placeholder="Descripción"
                                        name="empleados[{{ $empId }}][rebajos][0][descripcion]"
                                        value="{{ $data['rebajos'][0]['descripcion'] ?? '' }}">

                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                        placeholder="Monto" name="empleados[{{ $empId }}][rebajos][0][monto]"
                                        value="{{ $data['rebajos'][0]['monto'] ?? '' }}">
                                </td>

                                {{-- Rebajo 2 --}}
                                <td>
                                    <input type="text" class="form-control form-control-sm mb-1"
                                        placeholder="Descripción"
                                        name="empleados[{{ $empId }}][rebajos][1][descripcion]"
                                        value="{{ $data['rebajos'][1]['descripcion'] ?? '' }}">

                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                        placeholder="Monto" name="empleados[{{ $empId }}][rebajos][1][monto]"
                                        value="{{ $data['rebajos'][1]['monto'] ?? '' }}">
                                </td>

                                {{-- Rebajo 3 --}}
                                <td>
                                    <input type="text" class="form-control form-control-sm mb-1"
                                        placeholder="Descripción"
                                        name="empleados[{{ $empId }}][rebajos][2][descripcion]"
                                        value="{{ $data['rebajos'][2]['descripcion'] ?? '' }}">

                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                        placeholder="Monto" name="empleados[{{ $empId }}][rebajos][2][monto]"
                                        value="{{ $data['rebajos'][2]['monto'] ?? '' }}">
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">
                    Guardar planilla
                </button>
            </div>

        </form>
    </div>
@endsection
