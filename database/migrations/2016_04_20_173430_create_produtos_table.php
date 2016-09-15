<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',60);
            $table->string('descricao',60);
            $table->string('codigo_barra',60);
            $table->string('codigo_anterior',60);
            $table->integer('unidade_id')->unsigned();
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->integer('tipoitem_id')->unsigned();
            $table->foreign('tipoitem_id')->references('id')->on('tipoitens');
            $table->integer('ncm_id')->unsigned();
            $table->foreign('ncm_id')->references('id')->on('ncms');
            $table->integer('genero_id')->unsigned();
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->decimal('preco_venda',14,2);
            $table->decimal('icms',6,2);
            $table->string('lst',5);
            $table->string('ipi',3);
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
        Schema::drop('produtos');
    }
}
