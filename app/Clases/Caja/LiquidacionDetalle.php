<?php

namespace App\Clases\Caja;

use Illuminate\Database\Eloquent\Model;

class LiquidacionDetalle extends Model
{
    protected $fillable = [
        'uso_id','user_id','servicio','aprobador_id','motivo','detalle','monto','multimoneda','tiempo','liquidacion','neto'
    ];
}
