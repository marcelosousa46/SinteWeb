<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class natops extends Model
{
    protected $table    = 'natop';
    protected $fillable = ['id','codigo','descricao'];
}
