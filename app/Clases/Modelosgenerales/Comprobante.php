<?php

namespace App\Clases\Modelosgenerales;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $fillable = [
        'codigo', 'decripcion'
    ];
}
