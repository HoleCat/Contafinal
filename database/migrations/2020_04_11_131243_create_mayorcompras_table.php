<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMayorcomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mayorcompras', function (Blueprint $table) {
            $table->id();
            $table->string('IdUso')->nullable();
            $table->string('IdArchivo')->nullable();
            $table->string('Periodo')->nullable();
            $table->string('Correlativo')->nullable();
            $table->string('Orden')->nullable();
            $table->string('FecEmision')->nullable();
            $table->string('FecVenci')->nullable();
            $table->string('TipoComp')->nullable();
            $table->string('NumSerie')->nullable();
            $table->string('AnoDua')->nullable();
            $table->string('NumComp')->nullable();
            $table->string('NumTicket')->nullable();
            $table->string('TipoDoc')->nullable();
            $table->string('NroDoc')->nullable();
            $table->string('Nombre')->nullable();
            $table->string('BIAG1')->nullable();
            $table->string('IGVIPM1')->nullable();
            $table->string('BIAG2')->nullable();
            $table->string('IGVIPM2')->nullable();
            $table->string('BIAG3')->nullable();
            $table->string('IGVIPM3')->nullable();
            $table->string('AdqGrava')->nullable();
            $table->string('ISC')->nullable();
            $table->string('Otros')->nullable();
            $table->string('Total')->nullable();
            $table->string('Moneda')->nullable();
            $table->string('TipoCam')->nullable();
            $table->string('FecOrigenMod')->nullable();
            $table->string('TipoCompMod')->nullable();
            $table->string('NumSerieMod')->nullable();
            $table->string('AnoDuaMod')->nullable();
            $table->string('NumSerComOriMod')->nullable();
            $table->string('FecConstDetrac')->nullable();
            $table->string('NumConstDetrac')->nullable();
            $table->string('Retencion')->nullable();
            $table->string('ClasifBi')->nullable();
            $table->string('Contrato')->nullable();
            $table->string('ErrorT1')->nullable();
            $table->string('ErrorT2')->nullable();
            $table->string('ErrorT3')->nullable();
            $table->string('ErrorT4')->nullable();
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
        Schema::dropIfExists('mayorcompras');
    }
}
