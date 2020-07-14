<?php

namespace App\Clases;

use Illuminate\Database\Eloquent\Model;

class Uso extends Model
{
    protected $fillable = [
        'idusuario', 'uso_id', 'idtipo', 'referencia',
    ];

    protected function getfiles() {
        return $this->hasMany('App/Clases/Modelosgenerales/Archivo','idusuario','id');
    }

    protected function getUsos() {
        return $this->hasMany('App/Usos','uso_id','id');
    }

    public function post()
    {
        return $this->belongsTo('App\Uso');
    }
}
