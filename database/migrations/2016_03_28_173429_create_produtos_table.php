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
            $table->integer('id_unidade');
            $table->integer('id_tipoitem');
            $table->integer('id_ncm');
            $table->string('ipi',3);
            $table->string('id_genero',60);
            $table->string('lst',5);
            $table->decimal('icms',6,2);
            $table->integer('preco');
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
