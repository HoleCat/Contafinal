<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetraccionComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detraccion_compras', function (Blueprint $table) {
            $table->id();
            $table->integer('IdUso');
            $table->integer('IdArchivo');
            $table->string('Cuo');
            $table->string('TipoCuenta');
            $table->string('NumeroCuenta');
            $table->string('NumeroConstancia');
            $table->string('PeriodoTributario');
            $table->string('RucProveedor');
            $table->string('NombreProveedor');
            $table->string('TipoDocumentoAdquiriente');
            $table->string('NumeroDocumentoAdquiriente');
            $table->string('RazonSocialAdquiriente');
            $table->string('FechaPago');
            $table->string('MontoDeposito');
            $table->string('TipoBien');
            $table->string('TipoOperacion');
            $table->string('TipoComprobante');
            $table->string('SerieComprobante');
            $table->string('NumeroComprobante');
            $table->string('NumeroPagoDetraciones');
            $table->string('ValidacionPorcentual');
            $table->string('Base');
            $table->string('ValidacionBase');
            $table->string('TipoServicio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detraccion_compras');
    }
}
