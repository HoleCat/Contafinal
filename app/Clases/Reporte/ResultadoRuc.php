<?php

namespace App\Clases\Reporte;

use Illuminate\Database\Eloquent\Model;

class ResultadoRuc extends Model
{
   protected $fillable = [
    'IdUso',
    'IdArchivo',
    'NumeroRuc',
    'RazonSocial',
    'TipoContribuyente',
    'ProfesionOficio',
    'NombreComercial',
    'CondicionContribuyente',
    'EstadoContribuyente',
    'FechaInscripcion',
    'FechaInicioActividades',
    'Departamento',
    'Provincia',
    'Distrito',
    'Direccion',
    'Telefono',
    'Fax',
    'ActividadComercioExterior',
    'PrincipalCIIU',
    'CIIU1',
    'CIIU2',
    'RUS',
    'BuenContribuyente',
    'AgenteRetencion',
    'AgentePercepcionVtaInt',
    'AgentePercepcionComLiq',
   ];
}
