<?php

namespace App\Clases\Modelosgenerales;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $fillable = [
        'ruta','tipo','user_id','uso_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Uso');
    }
}
