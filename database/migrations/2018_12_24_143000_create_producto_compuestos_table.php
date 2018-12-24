<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoCompuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_compuestos', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('producto_padre_id')->unsigned()->index('fk_tblProductoCompuestoPadre_tblProducto_idx');
            $table->integer('producto_hijo_id')->unsigned()->index('fk_tblProductoCompuestoHijo_tblProducto_idx');

            $table->foreign('producto_padre_id', 'fk_tblProductoCompuestoPadre_tblProducto')->references('id')->on('productos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('producto_hijo_id', 'fk_tblProductoCompuestoHijo_tblProducto')->references('id')->on('productos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_compuestos');
    }
}
