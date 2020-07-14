<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacion_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('uso_id');
            $table->integer('user_id');
            $table->string('servicio');
            $table->integer('aprobador_id');
            $table->string('motivo');
            $table->string('detalle');
            $table->string('monto');
            $table->boolean('multimoneda');
            $table->integer('tiempo');
            $table->double('liquidacion');
            $table->double('neto');
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
        Schema::dropIfExists('liquidacion_detalles');
    }
}
