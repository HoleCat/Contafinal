<?php

namespace App\Clases\Caja;

use Illuminate\Database\Eloquent\Model;

class Aprobador extends Model
{
    protected $fillable = [
        'nombre','apellido','dni','telefono','correo','user_id'
    ];
}
