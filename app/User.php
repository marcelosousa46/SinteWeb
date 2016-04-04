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
                    ->join('permissoes', 'permissoes.users_id', '=', 'users.id')
                    ->join('rotinas', 'rotinas.id', '=', 'permissoes.rotinas_id')
                    ->select('rotinas.*')
                    ->where('users.id', $this->id)
                    ->where('rotinas.tipo', "0")
                    ->get();
    }

    public function Subrotinas($id){
         return DB::table('users')
                    ->join('permissoes', 'permissoes.users_id', '=', 'users.id')
                    ->join('rotinas', 'rotinas.id', '=', 'permissoes.rotinas_id')
                    ->select('rotinas.*')
                    ->where('users.id', $this->id)
                    ->where('rotinas.tipo', $id)
                    ->get();
    }

    public function Crud($rotina){
         return DB::table('permissoes')
                    ->join('users', 'users.id', '=', 'permissoes.users_id')
                    ->select('permissoes.crud')
                    ->where('users.id', $this->id)
                    ->where('permissoes.rotinas_id', $rotina)
                    ->get();
    }


}
