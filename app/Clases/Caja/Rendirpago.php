<?php

namespace App\Clases\Caja;

use Illuminate\Database\Eloquent\Model;

class Rendirpago extends Model
{
    protected $fillable = [
        'liquidacion_id'
        ,'ruc'
        ,'tipoDocumento'
        ,'codigodocumento'
        ,'documento'
        ,'fecha'
        ,'moneda'
        ,'concepto'
        ,'contabilidad'
        ,'centrocosto'
        ,'base'
        ,'monto'
        ,'igv'];
}
