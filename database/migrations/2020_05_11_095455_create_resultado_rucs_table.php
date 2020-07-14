<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoRucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_rucs', function (Blueprint $table) {
            $table->id();
            $table->integer('IdUso');
            $table->integer('IdArchivo');
            $table->string('NumeroRuc');
            $table->string('RazonSocial');
            $table->string('TipoContribuyente');
            $table->string('ProfesionOficio');
            $table->string('NombreComercial');
            $table->string('CondicionContribuyente');
            $table->string('EstadoContribuyente');
            $table->string('FechaInscripcion');
            $table->string('FechaInicioActividades');
            $table->string('Departamento');
            $table->string('Provincia');
            $table->string('Distrito');
            $table->string('Direccion');
            $table->string('Telefono');
            $table->string('Fax');
            $table->string('ActividadComercioExterior');
            $table->string('PrincipalCIIU');
            $table->string('CIIU1');
            $table->string('CIIU2');
            $table->string('RUS');
            $table->string('BuenContribuyente');
            $table->string('AgenteRetencion');
            $table->string('AgentePercepcionVtaInt');
            $table->string('AgentePercepcionComLiq');
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
        Schema::dropIfExists('resultado_rucs');
    }
}
