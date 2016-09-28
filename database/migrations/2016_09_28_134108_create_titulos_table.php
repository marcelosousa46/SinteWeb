<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notas_id')->unsigned();
            $table->foreign('notas_id')->references('id')->on('notas');
            $table->string('tipo',1);
            $table->string('codigo',20);
            $table->decimal('vl_doc',14,2);
            $table->decimal('vl_pagto',14,2);
            $table->decimal('vl_juros',14,2);
            $table->date('dt_doc');
            $table->date('dt_venc');
            $table->date('dt_pagto');
            $table->string('situacao',1);
            $table->string('obs',60);
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
        Schema::drop('titulos');
    }
}
