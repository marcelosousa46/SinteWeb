<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipoitens extends Model
{
    protected $table    = 'tipoitens';
    protected $fillable = ['id','codigo','descricao'];
}
