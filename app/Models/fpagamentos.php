<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fpagamentos extends Model
{
    protected $table    = 'fpagamentos';
    protected $fillable = [
	          'id',
	          'descricao',
	          'parcelas',
	          'intervalo'
    ];
}
