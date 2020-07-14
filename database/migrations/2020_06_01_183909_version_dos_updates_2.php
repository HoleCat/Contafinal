<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VersionDosUpdates2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cajachicas', function (Blueprint $table) {
            $table->bigInteger('ruc')->change();
        });

        Schema::table('rendirpagos', function (Blueprint $table) {
            $table->bigInteger('ruc')->change();
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
