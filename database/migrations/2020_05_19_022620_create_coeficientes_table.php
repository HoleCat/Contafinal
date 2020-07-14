<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoeficientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coeficientes', function (Blueprint $table) {
            $table->id();

            $table->integer('IdUso');

            $table->string('VentasNetas')->nullable();	
            $table->string('NroVentasNetas')->nullable();	

            $table->string('IngresosFinancierosGravados')->nullable();	
            $table->string('NroIngresosFinancierosGravados')->nullable();	

            $table->string('OtrosIngresosGravados')->nullable();	
            $table->string('NroOtrosIngresosGravados')->nullable();	

            $table->string('OtrosIngresosNoGravados')->nullable();	
            $table->string('NroOtrosIngresosNoGravados')->nullable();	

            $table->string('EnajenaciónValoresBienesAF')->nullable();	
            $table->string('NroEnajenaciónValoresBienesAF')->nullable();

            $table->string('REI')->nullable();	
            $table->string('NroREI')->nullable();	

            $table->string('TotalIngresosNetos')->nullable();	
            $table->string('NroTotalIngresosNetos');

            $table->string('IngresoDiferenciaCambio')->nullable();	
            $table->string('NroIngresoDiferenciaCambio')->nullable();	

            $table->string('IngresosNetos')->nullable();	
            $table->string('NroIngresosNetos')->nullable();	

            $table->string('ImpuestoCalculado')->nullable();	
            $table->string('NroImpuestoCalculado')->nullable();	

            $table->string('Coeficiente' )->nullable();	
            $table->string('NroCoeficiente' )->nullable();	

            $table->string('CoeficienteFinal')->nullable();	
            $table->string('NroCoeficienteFinal')->nullable();	

            $table->string('CoeficienteSUNAT')->nullable();	
            $table->string('NroCoeficienteSUNAT')->nullable();	

            $table->string('CoeficientePDT')->nullable();	
            $table->string('NroCoeficientePDT')->nullable();	

            $table->string('CoeficienteDefinitivo')->nullable();	
            $table->string('NroCoeficienteDefinitivo')->nullable();	

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
        Schema::dropIfExists('coeficientes');
    }
}
