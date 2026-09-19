@csrf
<div class="row">
    <div class="col"></div>
    <div class="col-6">

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Cédula</label>
            <input class="form-control" type="text" name="CEDULA" value="{{ old('CEDULA', $empleado->CEDULA ?? '') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Nombre</label>
            <input class="form-control" type="text" name="NOMBRE"
                value="{{ old('NOMBRE', $empleado->NOMBRE ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Apellido</label>
            <input class="form-control" type="text" name="APELLIDO"
                value="{{ old('APELLIDO', $empleado->APELLIDO ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Departamento</label>
            <select name="DEPARTAMENTO" class="form-select" required>
                <option value="">-- Seleccione --</option>
                @foreach ($departamentos as $d)
                    <option value="{{ $d->CODIGO }}" @selected(old('DEPARTAMENTO', $empleado->DEPARTAMENTO ?? '') == $d->CODIGO)>
                        {{ $d->DESCRIPCION }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Puesto</label>
            <input class="form-control" type="text" name="PUESTO"
                value="{{ old('PUESTO', $empleado->PUESTO ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Salario actual</label>
            <input class="form-control" type="number" step="0.010" name="SALARIOACTUAL"
                value="{{ old('SALARIOACTUAL', $empleado->SALARIOACTUAL ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Correo electrónico</label>
            <input class="form-control" type="email" name="CORREOELECTRONICO"
                value="{{ old('CORREOELECTRONICO', $empleado->CORREOELECTRONICO ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Teléfono</label>
            <input class="form-control" type="text" name="TELEFONO1"
                value="{{ old('TELEFONO1', $empleado->TELEFONO1 ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Dirección</label>
            <textarea class="form-control" id="textAreaExample5" rows="3" name="DIRECCION">{{ old('DIRECCION', $empleado->DIRECCION ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">CCSS</label>
            <select name="TIPO" class="form-select">
                <option value="0" @selected(old('TIPO', $empleado->TIPO ?? 0) == 0)>REGULAR</option>
                <option value="1" @selected(old('TIPO', $empleado->TIPO ?? 0) == 1)>PENSIONADO</option>
                <option value="2" @selected(old('TIPO', $empleado->TIPO ?? 0) == 2)>DOMESTICO</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Estado</label>
            <select name="ESTATUS" class="form-select">
                <option value="1" @selected(old('ESTATUS', $empleado->ESTATUS ?? 1) == 1)>Activo</option>
                <option value="0" @selected(old('ESTATUS', $empleado->ESTATUS ?? 1) == 0)>Inactivo</option>
            </select>
        </div>

        <button class="btn btn-primary px-4" type="submit">Guardar</button>
        <a class="btn btn-sm btn-danger " href="{{ route('empleados.index') }}">Cancelar</a>
    </div>
    <div class="col"></div>
</div>
