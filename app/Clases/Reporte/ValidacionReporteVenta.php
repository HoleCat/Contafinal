<?php

namespace App\Clases\Reporte;

use Illuminate\Database\Eloquent\Model;

class ValidacionReporteVenta extends Model
{       
    protected $guarded = [];

    protected $fillable =  [
        'flag1',
        'flag2',    
        'IdUso',
        'IdArchivo',
        'Periodo',
        'Correlativo',
        'Ordenado',
        'FecEmision',
        'FecVenci',
        'TipoComp',
        'NumSerie',
        'NumComp',
        'NumTicket',
        'TipoDoc',
        'NroDoc',
        'Nombre',
        'Export',
        'BI',
        'Desci',
        'IGVIPMBI',
        'IGVIPMDesc',
        'ImporteExo',
        'ImporteIna',
        'ISC',
        'BIIGVAP',
        'IGVAP',
        'Otros',
        'Total',
        'Moneda',
        'TipoCam',
        'FecOrigenMod',
        'TipoCompMod',
        'NumSerieMod',
        'NumDocMod',
        'Contrato',
        'ErrorT1',
        'MedioPago',
        'Estado'
    ];
}
