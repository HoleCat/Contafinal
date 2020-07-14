<?php

namespace App\clases\modelosgenerales;

use Illuminate\Database\Eloquent\Model;

class Dni extends Model
{
    protected $fillable = [
        'codigo','descripcion'
    ];
}
