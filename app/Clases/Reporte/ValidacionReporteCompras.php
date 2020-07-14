<?php

namespace App\Clases\Reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ValidacionReporteCompras extends Model
{
    protected $fillable = [
        'Liberar',
        'Status',
        'IdUso',
        'IdArchivo',
        'Periodo',
        'Correlativo',
        'Orden',
        'FecEmision',
        'FecVenci',
        'TipoComp',
        'NumSerie',
        'AnoDua',
        'NumComp',
        'NumTicket',
        'TipoDoc',
        'NroDoc',
        'Nombre',
        'BIAG1',
        'IGVIPM1',
        'BIAG2',
        'IGVIPM2',
        'BIAG3',
        'IGVIPM3',
        'AdqGrava',
        'ISC',
        'Otros',
        'Total',
        'Moneda',
        'TipoCam',
        'FecOrigenMod',
        'TipoCompMod',
        'NumSerieMod',
        'AnoDuaMod',
        'NumSerComOriMod',
        'FecConstDetrac',
        'NumConstDetrac',
        'Retencion',
        'ClasifBi',
        'Contrato',
        'ErrorT1',
        'ErrorT2',
        'ErrorT3',
        'ErrorT4',
        'MedioPago',
        'Estado'
    ];

    public static function ListarCompras($empresa,$ruc,$periodo,$iduso) {
        
    }
}
