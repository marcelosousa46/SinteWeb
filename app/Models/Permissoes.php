<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{
    protected $table    = 'Permissoes';
    protected $fillable = ['id','id_users','id-rotinas', 'tipo', 'crud'];

    public $timestamps = false;
    
    public function PermissoesUsers() {
        return $this->hasMany('App\Users');    
    }

    public function PermissoesRotinas() {
        return $this->hasMany('App\Models\Rotinas');    
    }
  
}
