<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $primaryKey = 'CODIGO';

    public $timestamps = false;

    protected $fillable = [
        'CEDULA',
        'NOMBRE',
        'APELLIDO',
        'FECHAINGRESO',
        'PUESTO',
        'SALARIOACTUAL',
        'DEPARTAMENTO',
        'CORREOELECTRONICO',
        'TELEFONO1',
        'DIRECCION',
        'ESTATUS',
        'TIPO',
    ];
    /* ================= RELACIONES ================= */

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'DEPARTAMENTO', 'CODIGO');
    }

    public function salarios()
    {
        return $this->hasMany(Salario::class, 'EMPLEADO', 'CODIGO');
    }

    public function deducciones()
    {
        return $this->hasMany(InfDeduccion::class, 'EMPLEADO', 'CODIGO');
    }

    public function vacaciones()
    {
        return $this->hasMany(Vacacion::class, 'EMPLEADO', 'CODIGO');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'empleado_id', 'CODIGO');
    }
}
