<?php

namespace App\Clases\Reporte;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $fillable = ['IdUso','Orden','Mes','Ir','Credito','Saldo','Itan'];
}
