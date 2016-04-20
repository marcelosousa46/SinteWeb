<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ncms extends Model
{
    protected $table    = 'ncms';
    protected $fillable = ['id','codigo','descricao'];
}
