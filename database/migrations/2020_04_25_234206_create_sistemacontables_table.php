<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSistemacontablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sistemacontables', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->integer('user_id');
            $table->string('MANDANTE');
            $table->string('INTERFAZ');
            $table->string('CORRELAT');
            $table->string('NITEM');
            $table->string('BUKRS');
            $table->string('BUPLA');
            $table->string('NEWBS');
            $table->string('NEWUM');
            $table->string('NEWBK');
            $table->string('FWBAS');
            $table->string('MWSKZ');
            $table->string('GSBER');
            $table->string('AUFNR');
            $table->string('ZTERM');
            $table->string('VBUND');
            $table->string('XREF1');
            $table->string('XREF2');
            $table->string('XREF3');
            $table->string('VALUT');
            $table->string('XMWST');
            $table->string('ZLSPR');
            $table->string('ZFBDT');
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
        Schema::dropIfExists('sistemacontables');
    }
}
