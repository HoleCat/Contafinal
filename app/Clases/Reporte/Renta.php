<?php

namespace App\Clases\Reporte;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'IdUso',
        'IdArchivo',
        'Numero',
        'Nombrecuenta',
        'Dia',
        'Mes',
        'Año',
        'Acumulado'
    ];
}
