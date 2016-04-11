<?php
namespace App\Classes;

use Validator;
use Illuminate\Http\Request;
use App\User;
use App\Models\Rotinas;
use App\Models\Permissoes;
use DB;

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
     public function gerarPermissoes($user_id)
     {
        $gerado = false;
        $rotinas = Rotinas::all();
        foreach ($rotinas as $value) {

          $retorno = DB::table('permissoes')
                         ->select('*')
                         ->where('users_id', $user_id)
                         ->where('rotinas_id', $value->id)
                         ->get();
          if ($retorno == null)
          {     
            $permissao = new Permissoes;
            $permissao->users_id   = $user_id;
            $permissao->rotinas_id = $value->id;
            $permissao->liberado   = 'A';
            $permissao->incluir    = 'A';
            $permissao->alterar    = 'A';
            $permissao->consultar  = 'A';
            $permissao->excluir    = 'A';
            $permissao->save();
          }  
        }
        $gerado = true;
        return $gerado;
     }
}
