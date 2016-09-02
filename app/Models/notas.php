<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class notas extends Model
{
    protected $table    = 'notas';
    protected $fillable = [
            'id',
            'ind_oper',
            'ind_emit',
            'cod_part',
            'cod_mod',
            'cod_sitr',
            'ser',
            'num_doc',
            'chv_nfe',
            'dt_doc',
            'dt_e_s',
            'vl_doc',
            'ind_pagto',
            'vl_desc',
            'vl_abat_nt',
            'vl_merc',
            'ind_frt',
            'vl_frt',
            'vl_seg',
            'vl_out_da',
            'vl_bc_icms',
            'vl_icms',
            'vl_bc_icms_st',
            'vl_icms_st',
            'vl_ipi',
            'vl_pis',
            'vl_cofins',
            'vl_pis_st',
            'vl_cofins_st'
    ];
}
