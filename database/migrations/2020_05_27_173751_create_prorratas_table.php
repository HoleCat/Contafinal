<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProrratasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prorratas', function (Blueprint $table) {
            $table->id();
            $table->integer('IdUso');
            $table->string('Periodo');
            $table->string('VentasNacionalesGravadas');
            $table->string('Exportaciones');
            $table->string('VentasNoGravadas');
            $table->string('boletasexoneradas');
            $table->string('NCBOLETASEXONE');
            $table->string('TotalVtasNoGrav');
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
        Schema::dropIfExists('prorratas');
    }
}
