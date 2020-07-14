<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMayorgastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mayorgastos', function (Blueprint $table) {
            $table->id();
            $table->string('IdUso')->nullable();
            $table->string('IdArchivo')->nullable();
            $table->string('Periodo')->nullable();
            $table->string('CUO')->nullable();
            $table->string('AMC')->nullable();
            $table->string('Cuenta')->nullable();
            $table->string('Unid_Econ')->nullable();
            $table->string('CentroCosto')->nullable();
            $table->string('Moneda')->nullable();
            $table->string('TipoDoc1')->nullable();
            $table->string('Numero')->nullable();
            $table->string('TipoDoc2')->nullable();
            $table->string('NumSerie')->nullable();
            $table->string('NumComp')->nullable();
            $table->string('FecEmision')->nullable();
            $table->string('FecVenci')->nullable();
            $table->string('FecOperacion')->nullable();
            $table->string('Glosa1')->nullable();
            $table->string('Glosa2')->nullable();
            $table->string('Debe')->nullable();
            $table->string('Haber')->nullable();
            $table->string('RefenciaCompraVenta')->nullable();
            $table->string('IndOP')->nullable();
            $table->string('Diferenciar')->nullable();
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
        Schema::dropIfExists('mayorgastos');
    }
}
