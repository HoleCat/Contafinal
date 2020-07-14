<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->integer("uso_id");
            $table->integer("usuario_id");
            $table->string("key");
            $table->string("codigo_doc");
            $table->string("serie");
            $table->string("numero");
            $table->string("fecha_emision");
            $table->string("direccion_entrega");
            $table->string("moneda");
            $table->string("ruc_proveedor");  
            $table->string("razon_social_proveedor");
            $table->string("ruc_cliente");
            $table->string("razon_social_cliente");
            $table->string("ubigeo")->nullable();
            $table->double("igv");        
            $table->double("valor_venta");
            $table->double("total"); 
            $table->string("descripcion"); 
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
        Schema::dropIfExists('facturas');
    }
}
