<?php

namespace App\Clases\Reporte;

use Illuminate\Database\Eloquent\Model;

class DetraccionCompras extends Model
{
    protected $guarded = [];

    protected $fillable = 
    [
        'IdUso'
        ,'IdArchivo'
        ,'TipoCuenta'
        ,'NumeroCuenta'
        ,'NumeroConstancia'
        ,'PeriodoTributario'
        ,'RucProveedor'
        ,'NombreProveedor'
        ,'TipoDocumentoAdquiriente'
        ,'NumeroDocumentoAdquiriente'
        ,'RazonSocialAdquiriente'
        ,'FechaPago'
        ,'MontoDeposito'
        ,'TipoBien'
        ,'TipoOperacion'
        ,'TipoComprobante'
        ,'SerieComprobante'
        ,'NumeroComprobante'
        ,'NumeroPagoDetraciones'
        ,'ValidacionPorcentual'
        ,'Base'
        ,'ValidacionBase'
        ,'TipoServicio'
    ];
}
