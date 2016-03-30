<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRotinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rotinas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',60);
            $table->string('url',60);
            $table->string('tipo',1);  /* Para Rotina tipo  = 0 e Sub-rotinas tipo = 1*/              
            $table->string('nivel',1); /* Para Subrotinas Nivel da rotina */        
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
        Schema::drop('rotinas');
    }
}
