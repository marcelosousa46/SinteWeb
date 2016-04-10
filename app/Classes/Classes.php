<?php
namespace App\Classes;

use Validator;
use Illuminate\Http\Request;
use App\User;

class Classes {
    public function getPermissao($request)
    {
       $autorizado = false;
       if ($request->session()->has('rotina_id')) {
          $crud = auth()->user()->Crud(session('rotina_id'));
          $autorizacao = $crud[0]->alterar;
        }
        if ($autorizacao == 'A'){
        	 $autorizado = true;
        }
        return $autorizado;
     }
}
