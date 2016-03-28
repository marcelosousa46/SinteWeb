<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Rotinas extends Model
{
    protected $table    = 'rotinas';
    protected $fillable = ['id','descricao','tabela', 'tipo'];
   
}
