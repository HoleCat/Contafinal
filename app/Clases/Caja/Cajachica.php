<?php

namespace App\Clases\Caja;

use Illuminate\Database\Eloquent\Model;

class Cajachica extends Model
{
    
    protected $fillable = [
    'liquidacion_id'
    ,'ruc'
    ,'tipoDocumento'
    ,'codigodocumento'
    ,'documento'
    ,'fecha'
    ,'moneda'
    ,'cambio'
    ,'concepto'
    ,'contabilidad'
    ,'centrocosto'
    ,'base'
    ,'monto'
    ,'igv'];
    
}
