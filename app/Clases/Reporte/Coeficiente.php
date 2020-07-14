<?php

namespace App\Clases\Reporte;

use Illuminate\Database\Eloquent\Model;

class Coeficiente extends Model
{
    protected $fillable = [
        'VentasNetas',
        'NroVentasNetas',

        'IngresosFinancierosGravados',
        'NroIngresosFinancierosGravados',

        'OtrosIngresosGravados',
        'NroOtrosIngresosGravados',

        'OtrosIngresosNoGravados',
        'NroOtrosIngresosNoGravados',

        'EnajenaciónValoresBienesAF',
        'NroEnajenaciónValoresBienesAF',

        'REI',
        'NroREI',

        'TotalIngresosNetos',
        'NroTotalIngresosNetos',

        'IngresoDiferenciaCambio',
        'NroIngresoDiferenciaCambio',

        'IngresosNetos',
        'NroIngresosNetos',

        'ImpuestoCalculado',
        'NroImpuestoCalculado',

        'Coeficiente' ,
        'NroCoeficiente' ,

        'CoeficienteFinal',
        'NroCoeficienteFinal',

        'CoeficienteSUNAT',
        'NroCoeficienteSUNAT',

        'CoeficientePDT',
        'NroCoeficientePDT',

        'CoeficienteDefinitivo',
        'NroCoeficienteDefinitivo',
    ];
}
