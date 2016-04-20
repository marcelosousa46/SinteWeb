<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precos extends Model
{
    protected $table    = 'precos';
    protected $fillable = ['id','custo_compra','custo_medio', 'venda',
                           'promocao'];
}
