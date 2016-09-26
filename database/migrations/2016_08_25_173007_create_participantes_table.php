<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',20);
            $table->string('nome',60);
            $table->string('pais',20);
            $table->string('cpais',4);
            $table->string('cnpj',14);
            $table->string('cpf',14);
            $table->string('ie',14);
            $table->string('uf',2);
            $table->string('municipio',20);
            $table->string('suframa',9);
            $table->string('endereco',60);
            $table->string('numero',10);
            $table->string('complemento',60);
            $table->string('bairro',20);
            $table->string('cep',8);
            $table->string('email',60);
            $table->string('fone',12);
            $table->string('ibge',7);
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
        Schema::drop('participantes');
    }
}
