<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $table    = 'series';
    protected $fillable = ['id','ultimo','descricao'];
}
