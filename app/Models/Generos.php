<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generos extends Model
{
    protected $table    = 'generos';
    protected $fillable = ['id','codigo','descricao'];
}
