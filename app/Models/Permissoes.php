<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Permissoes extends Model
{
    protected $table    = 'permissoes';
    protected $fillable = ['id','users_id','rotinas_id', 'tipo', 'liberado', 
                           'incluir', 'alterar', 'consultar', 'excluir'];
    protected $rotinas;

    public function Users() {
        return $this->belongsTo('App\User');
    }

    public function Rotinas() {
        return $this->hasMany('App\models\Rotinas','id', 'rotinas_id');
    }
	public function Dados() {
	    $this->rotinas = Auth::user()->Rotinas();
	    return true;
	}

}
