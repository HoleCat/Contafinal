<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRendirpagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendirpagos', function (Blueprint $table) {
            $table->id();
            $table->integer('liquidacion_id');
            $table->integer('ruc');
            $table->integer('tipodocumento');
            $table->string('codigodocumento');
            $table->integer('documento');
            $table->date('fecha');
            $table->double('moneda');
            $table->double('cambio');
            $table->string('concepto');
            $table->integer('contabilidad');
            $table->string('centrocosto');
            $table->double('base');
            $table->double('monto');
            $table->double('igv');
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
        Schema::dropIfExists('rendirpagos');
    }
}
