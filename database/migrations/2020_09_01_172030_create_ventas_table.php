<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("id_usuario")->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->bigInteger('id_caja')->unsigned();
            $table->foreign('id_caja')->references('id')->on('cajas');
            $table->double('total', 8, 2);
            $table->string('metodoPago',50);
            $table->string('detalleMetodoPago',50);
            $table->boolean('estado');
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
        Schema::dropIfExists('ventas');
    }
}
