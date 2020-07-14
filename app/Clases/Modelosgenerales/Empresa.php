<?php

namespace App\Clases\Modelosgenerales;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['user_id','nombre','razonsocial','ruc','codigo','telefono','direccion','pagina','foto'];
}
