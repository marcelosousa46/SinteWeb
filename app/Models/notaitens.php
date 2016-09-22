<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class notaitens extends Model
{
    protected $table    = 'notaitens';
    protected $fillable = [
            'id',
            'notas_id',
            'num_item',
            'produtos_id',
            'desc_compl',
            'qtd',
            'unid',
            'vl_item',
            'vl_desc',
            'ind_mov',
            'cst_icms',
            'natop_id',
            'cod_nat',
            'vl_bc_icms',
            'aliq_icms',
            'vl_icms',
            'vl_bc_icms_ST',
            'aliq_st',
            'vl_icms_st',
            'ind_apur',
            'cst_ipi',
            'cod_enq',
            'vl_bc_ipi',
            'aliq_ipi',
            'vl_ipi',
            'cst_pis',
            'vl_bc_pis',
            'aliq_pis',
            'quant_bc_pis',
            'vl_pis',
            'cst_cofins',
            'vl_bc_cofins',
            'aliq_cofins',
            'quant_bc_cofins',
            'vl_cofins',
            'cod_conta',
    ];       
    public function produtos() {
        return $this->belongsTo('App\Models\produtos');
    }

}
