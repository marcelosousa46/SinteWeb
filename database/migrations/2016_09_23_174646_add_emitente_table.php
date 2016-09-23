<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmitenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emitente', function (Blueprint $table) {
        $table->increments('id');
        $table->string('xLgr',60);
        $table->string('nro',15);
        $table->string('xcpl',60);
        $table->string('xbairro',20);
        $table->string('cmun',7);
        $table->string('xmun',20);
        $table->string('uf',2);
        $table->string('cuf',2);
        $table->string('cep',8);
        $table->string('cpais',4);
        $table->string('xpais',60);
        $table->string('fone',20);
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
        Schema::drop('notas');
    }
}
