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
            $table->string('codigo',60);
            $table->string('nome',100);
            $table->integer('pais_id');
            $table->biginteger('cnpj');
            $table->integer('cpf');
            $table->string('ie',14);
            $table->integer('municipio_id');
            $table->string('suframa',9);
            $table->string('endereco',60);
            $table->string('numero',10);
            $table->string('complemento',60);
            $table->string('bairro',60);
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
