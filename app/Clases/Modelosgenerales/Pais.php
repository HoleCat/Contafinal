<?php

namespace App\clases\modelosgenerales;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $fillable = [
        'codigo','descripcion'
    ];
}
