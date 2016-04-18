<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table    = 'produtos';
    protected $fillable = ['id','codigo','descricao', 'codigo_barra',
                           'codigo_anterior', 'id_unidade', 'id_tipoitem',
                           'id_ncm', 'ipi', 'id_genero', 'lst', 'icms',
                           'preco'];
}
