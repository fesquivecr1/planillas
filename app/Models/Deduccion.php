<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Deduccion extends Model
{
    protected $table = 'deducciones';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'INFOLINK',
        'SALARIO',
        'DESCRIPCION',
        'MONTO',
        'TIPO'
    ];
}

