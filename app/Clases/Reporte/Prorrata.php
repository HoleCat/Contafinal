<?php

namespace App\Clases\Reporte;

use Illuminate\Database\Eloquent\Model;

class Prorrata extends Model
{
    protected $fillable = ['IdUso','Orden','Periodo','VentasNacionalesGravadas','Exportaciones','VentasNoGravadas','boletasexoneradas','NCBOLETASEXONE','TotalVtasNoGrav'];
}
