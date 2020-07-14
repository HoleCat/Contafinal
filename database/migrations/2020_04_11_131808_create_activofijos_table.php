<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivofijosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activofijos', function (Blueprint $table) {
            $table->id();
            $table->string('IdUso')->nullable();
            $table->string('IdArchivo')->nullable();
            $table->string('Codigo')->nullable();
            $table->string('CuentaContable')->nullable();
            $table->string('Descipcion')->nullable();
            $table->string('Marca')->nullable();
            $table->string('Modelo')->nullable();
            $table->string('NumeroSeriePlaca')->nullable();
            $table->string('CostoFin')->nullable();
            $table->string('Adquisicion')->nullable();
            $table->string('Mejoras')->nullable();
            $table->string('RetirosBajas')->nullable();
            $table->string('Otros')->nullable();
            $table->string('ValorHistorico')->nullable();
            $table->string('AjusteInflacion')->nullable();
            $table->string('ValorAjustado')->nullable();
            $table->string('CostoNetoIni')->nullable();
            $table->string('FecAdquisicion')->nullable();
            $table->string('FecInicio')->nullable();
            $table->string('Metodo')->nullable();
            $table->string('NroDoc')->nullable();
            $table->string('PorcDepreciacion')->nullable();
            $table->string('DepreAcumulada')->nullable();
            $table->string('DepreEjercicio')->nullable();
            $table->string('DepreRelacionada')->nullable();
            $table->string('DepreOtros')->nullable();
            $table->string('DepreHistorico')->nullable();
            $table->string('DepreAjusInflacion')->nullable();
            $table->string('DepreAcuInflacion')->nullable();
            $table->string('CostoHistorico')->nullable();
            $table->string('DepreAcuTributaria')->nullable();
            $table->string('CostoNetoIniTributaria')->nullable();
            $table->string('DepreEjercicioTributaria')->nullable();
            $table->string('FecBaja')->nullable();
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
        Schema::dropIfExists('activofijos');
    }
}
