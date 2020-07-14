<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidacionReporteVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validacion_reporte_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('flag1')->nullable();
            $table->string('flag2')->nullable();
            $table->integer('IdUso')->nullable();
            $table->integer('IdArchivo')->nullable();
            $table->string('Periodo')->nullable();
            $table->string('Correlativo')->nullable();
            $table->string('Ordenado')->nullable();
            $table->string('FecEmision')->nullable();
            $table->string('FecVenci')->nullable();
            $table->string('TipoComp')->nullable();
            $table->string('NumSerie')->nullable();
            $table->integer('NumComp')->nullable();
            $table->string('NumTicket')->nullable();
            $table->string('TipoDoc')->nullable();
            $table->string('NroDoc')->nullable();
            $table->string('Nombre')->nullable();
            $table->string('Export')->nullable();
            $table->string('BI')->nullable();
            $table->string('Desci')->nullable();
            $table->string('IGVIPMBI')->nullable();
            $table->string('IGVIPMDesc')->nullable();
            $table->string('ImporteExo')->nullable();
            $table->string('ImporteIna')->nullable();
            $table->string('ISC')->nullable();
            $table->string('BIIGVAP')->nullable();
            $table->string('IGVAP')->nullable();
            $table->string('Otros')->nullable();
            $table->string('Total')->nullable();
            $table->string('Moneda')->nullable();
            $table->string('TipoCam')->nullable();
            $table->string('FecOrigenMod')->nullable();
            $table->string('TipoCompMod')->nullable();
            $table->string('NumSerieMod')->nullable();
            $table->string('NumDocMod')->nullable();
            $table->string('Contrato')->nullable();
            $table->string('ErrorT1')->nullable();
            $table->string('MedioPago')->nullable();
            $table->string('Estado')->nullable();
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
        Schema::dropIfExists('validacion_reporte_ventas');
    }
}
