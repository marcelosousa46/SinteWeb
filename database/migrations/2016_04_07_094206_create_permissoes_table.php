<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
            $table->integer('rotinas_id')->unsigned();
            $table->foreign('rotinas_id')->references('id')->on('rotinas');
            $table->string('liberado',1);
            $table->string('incluir',1);
            $table->string('alterar',1);
            $table->string('consultar',1);
            $table->string('excluir',1);
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
        Schema::drop('permissoes');
    }
}
