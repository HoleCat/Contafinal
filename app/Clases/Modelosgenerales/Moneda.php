<?php

namespace App\Clases\Modelosgenerales;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $fillable = [
        'codigo','descripcion','idpais'
    ];
}
