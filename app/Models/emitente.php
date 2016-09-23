<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class emitente extends Model
{
    protected $table    = 'emitente';
    protected $fillable = [
            'id',
            'xLgr',
            'nro',
            'xcpl',
            'xbairro',
            'cmun',
            'xmun',
            'uf',
            'cuf',
            'cep',
            'cpais',
            'xpais',
            'fone'
    ];
            

}
