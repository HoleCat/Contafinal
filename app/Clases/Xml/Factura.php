<?php

namespace App\Clases\Xml;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //protected $fillable = ['codigo_doc', 'serie','numero','ruc_proveedor','razon_social_proveedor','ruc_cliente','razon_social_cliente', 'ubigeo', 'igv', 'valor_venta', 'total', 'descripcion'];
    protected $fillable = ['ruc_proveedor','razon_social_proveedor','fecha_emision','codigo_doc', 'serie','numero','razon_social_cliente','ruc_cliente','descripcion', 'moneda', 'valor_venta', 'igv', 'total', 'direccion_entrega', 'ubigeo'];
}
