<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFpagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',20);
            $table->integer('parcelas');
            $table->integer('intervalo');
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
        Schema::drop('fpagamentos');
    }
}
