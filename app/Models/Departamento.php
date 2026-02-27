<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $primaryKey = 'CODIGO';
    public $timestamps = false;

    protected $fillable = [
        'DESCRIPCION'
    ];

    public function empleados(): HasMany
    {
        return $this->hasMany(Empleado::class, 'DEPARTAMENTO', 'CODIGO');
    }
}
