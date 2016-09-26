<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaitensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaitens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notas_id')->unsigned();
            $table->foreign('notas_id')->references('id')->on('notas');
            $table->integer('num_item');
            $table->integer('produtos_id')->unsigned();
            $table->foreign('produtos_id')->references('id')->on('produtos');
            $table->string('desc_compl');
            $table->decimal('qtd',14,4);
            $table->string('unid',6);
            $table->decimal('vl_item',14,2);
            $table->decimal('vl_desc',14,2);
            $table->string('ind_mov',1);
            $table->integer('cst_icms');
            $table->integer('natop_id')->unsigned();
            $table->foreign('natop_id')->references('id')->on('natop');
            $table->string('cod_nat',10);
            $table->decimal('vl_bc_icms',14,2);
            $table->decimal('aliq_icms',6,2);
            $table->decimal('vl_icms',14,2);
            $table->decimal('vl_bc_icms_ST',14,2);
            $table->decimal('aliq_st',6,2);
            $table->decimal('vl_icms_st',14,2);
            $table->string('ind_apur',1);
            $table->string('cst_ipi',2);
            $table->string('cod_enq',3);
            $table->decimal('vl_bc_ipi',14,2);
            $table->decimal('aliq_ipi',6,2);
            $table->decimal('vl_ipi',14,2);
            $table->string('cst_pis',2);
            $table->decimal('vl_bc_pis',14,2);
            $table->decimal('aliq_pis',6,2);
            $table->decimal('quant_bc_pis',6,3);
            $table->decimal('vl_pis',14,2);
            $table->string('cst_cofins',2);
            $table->decimal('vl_bc_cofins',14,2);
            $table->decimal('aliq_cofins',6,2);
            $table->decimal('quant_bc_cofins',6,3);
            $table->decimal('vl_cofins',14,2);
            $table->string('cod_conta',60);
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
        Schema::drop('notaitens');
    }
}
