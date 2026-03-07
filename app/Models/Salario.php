<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    protected $table = 'salarios';
    protected $primaryKey = 'CONSECUTIVO';
    public $timestamps = false;

    protected $fillable = [
        'EMPLEADO',
        'FECHA',
        'MONTOBRUTO',
        'TOTALINCENTIVO',
        'DEDUCCIONES',
        'HORASLABORADAS',
        'HORASEXTRA',
        'AHORRO',
        'DEPARTAMENTO',
        'VACACIONES',
        'DIASVAC',
        'DESCINC'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'EMPLEADO', 'CODIGO');
    }

    public function deducciones()
    {
        return $this->hasMany(Deduccion::class, 'SALARIO', 'CONSECUTIVO');
    }
}
