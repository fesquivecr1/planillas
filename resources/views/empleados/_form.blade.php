@csrf
<div class="row">
    <div class="col"></div>
    <div class="col-6 bg-secondary-subtle">
        <div class="mb-3">
            <label class="form-label">Cédula</label>
            <input class="form-control" type="text" name="CEDULA" value="{{ old('CEDULA', $empleado->CEDULA ?? '') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input class="form-control" type="text" name="NOMBRE"
                value="{{ old('NOMBRE', $empleado->NOMBRE ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input class="form-control" type="text" name="APELLIDO"
                value="{{ old('APELLIDO', $empleado->APELLIDO ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Departamento</label>
            <select name="DEPARTAMENTO" required>
                <option value="">-- Seleccione --</option>
                @foreach ($departamentos as $d)
                    <option value="{{ $d->CODIGO }}" @selected(old('DEPARTAMENTO', $empleado->DEPARTAMENTO ?? '') == $d->CODIGO)>
                        {{ $d->DESCRIPCION }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Puesto</label>
            <input class="form-control" type="text" name="PUESTO"
                value="{{ old('PUESTO', $empleado->PUESTO ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Salario actual</label>
            <input class="form-control" type="number" step="1000" name="SALARIOACTUAL"
                value="{{ old('SALARIOACTUAL', $empleado->SALARIOACTUAL ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Correo electrónico</label>
            <input class="form-control" type="email" name="CORREOELECTRONICO"
                value="{{ old('CORREOELECTRONICO', $empleado->CORREOELECTRONICO ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input class="form-control" type="text" name="TELEFONO1"
                value="{{ old('TELEFONO1', $empleado->TELEFONO1 ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <textarea name="DIRECCION">{{ old('DIRECCION', $empleado->DIRECCION ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="TIPO">
                <option value="0" @selected(old('TIPO', $empleado->TIPO ?? 0) == 0)>REGULAR</option>
                <option value="1" @selected(old('TIPO', $empleado->TIPO ?? 0) == 1)>PENSIONADO</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="ESTATUS">
                <option value="1" @selected(old('ESTATUS', $empleado->ESTATUS ?? 1) == 1)>Activo</option>
                <option value="0" @selected(old('ESTATUS', $empleado->ESTATUS ?? 1) == 0)>Inactivo</option>
            </select>
        </div>

        <button type="submit">Guardar</button>
        <a href="{{ route('empleados.index') }}">Cancelar</a>
    </div>
    <div class="col"></div>
</div>
