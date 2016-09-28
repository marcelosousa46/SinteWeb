<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class titulos extends Model
{
    protected $table    = 'titulos';
    protected $fillable = [
	          'id',
	          'notas_id',
	          'tipo',
	          'codigo',
	          'vl_doc',
	          'vl_pagto',
	          'vl_juros',
	          'dt_doc',
	          'dt_venc',
	          'dt_pagto',
	          'situacao',
	          'obs'
    ];

}
