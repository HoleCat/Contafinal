<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VersionDosUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cajachicas', function (Blueprint $table) {
            $table->dropColumn('cambio');
            $table->double('compra');
            $table->double('venta');
        });

        Schema::table('rendirpagos', function (Blueprint $table) {
            $table->dropColumn('cambio');
            $table->double('compra');
            $table->double('venta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
