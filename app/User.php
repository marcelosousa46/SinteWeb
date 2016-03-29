<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Rotinas(){
         return DB::table('users')
                    ->join('Permissoes', 'Permissoes.users_id', '=', 'users.id')
                    ->join('rotinas', 'rotinas.id', '=', 'Permissoes.rotinas_id')
                    ->select('rotinas.*')
                    ->where('users.id', $this->id)
                    ->where('rotinas.tipo', "0")
                    ->get();
    }

    public function Subrotinas($tabela){
         return DB::table('users')
                    ->join('Permissoes', 'Permissoes.users_id', '=', 'users.id')
                    ->join('rotinas', 'rotinas.id', '=', 'Permissoes.rotinas_id')
                    ->select('rotinas.*')
                    ->where('users.id', $this->id)
                    ->where('rotinas.tipo', "1")
                    ->where('rotinas.tabela', $tabela)
                    ->get();
    }

}
