<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{
    protected $table    = 'Permissoes';
    protected $fillable = ['id','users_id','rotinas_id', 'tipo', 'crud'];

    public function Users() {
        return $this->belongsTo('App\User');    
    }

    public function Rotinas() {
        return $this->hasMany('App\models\Rotinas','id', 'rotinas_id');    
    }
  
}
