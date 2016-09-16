<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table    = 'produtos';
    protected $fillable = ['id','codigo','descricao', 'codigo_barra',
                           'codigo_anterior', 'unidade_id', 'tipoitem_id',
                           'ncm_id', 'ipi', 'genero_id', 'lst', 'icms',
                           'preco_venda','cst','pis','cofins'];
    public function Unidade() {
        return $this->belongsTo('App\Models\Unidades');
    }
    public function Tipoitem() {
        return $this->belongsTo('App\Models\Tipoitens');
    }
    public function Ncm() {
        return $this->belongsTo('App\Models\Ncms');
    }
    public function Genero() {
        return $this->belongsTo('App\Models\Generos');
    }

}
