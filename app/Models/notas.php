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
            'natop_id',
            'participante_id',
            'cod_mod',
            'cod_sit',
            'tpemis',
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
            'vl_cofins_st',
            'serie_id',
            'cStat',
            'xMotivo',
            'nRec',
            'nProt',
            'fpagamento_id'
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($nota) { 
             $nota->itens()->delete();
             $nota->titulos()->delete();
        });
    }    

    public function series() {
        return $this->belongsTo('App\Models\Series');
    }
    public function itens()
    {
        return $this->hasMany('App\Models\notaitens');
    }
    public function titulos()
    {
        return $this->hasMany('App\Models\titulos');
    }
    public function participante() {
        return $this->belongsTo('App\Models\participantes');
    }
    public function natop() {
        return $this->belongsTo('App\Models\natops');
    }
}
