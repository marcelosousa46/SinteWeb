<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ind_oper',1);
            $table->string('ind_emit',1);
            $table->integer('participante_id')->unsigned();
            $table->foreign('participante_id')->references('id')->on('participantes');
            $table->integer('natop_id')->unsigned();
            $table->foreign('natop_id')->references('id')->on('natop');
            $table->string('cod_mod',2);
            $table->string('cod_sit',2);
            $table->string('ser',3);
            $table->integer('num_doc');
            $table->string('chv_nfe',44);
            $table->date('dt_doc');
            $table->date('dt_e_s');
            $table->decimal('vl_doc',14,2);
            $table->string('ind_pagto',1);
            $table->decimal('vl_desc',14,2);
            $table->decimal('vl_abat_nt',14,2);
            $table->decimal('vl_merc',14,2);
            $table->string('ind_frt',1);
            $table->decimal('vl_frt',14,2);
            $table->decimal('vl_seg',14,2);
            $table->decimal('vl_out_da',14,2);
            $table->decimal('vl_bc_icms',14,2);
            $table->decimal('vl_icms',14,2);
            $table->decimal('vl_bc_icms_st',14,2);
            $table->decimal('vl_icms_st',14,2);
            $table->decimal('vl_ipi',14,2);
            $table->decimal('vl_pis',14,2);
            $table->decimal('vl_cofins',14,2);
            $table->decimal('vl_pis_st',14,2);
            $table->decimal('vl_cofins_st',14,2);
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
