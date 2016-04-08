<?php
use App\User;

class getPermissao($var)
{
     $autorizado = false;
     if ($request->session()->has('rotina_id')) {
        $crud = auth()->user()->Crud(session('rotina_id'));
        $autorizacao = $crud[0]->alterar;
      }
      $this->validate($request, [
              'usuario' => "in:$autorizacao,'A'",
          ]);

      if ($autorizacao == 'A'){
      	 $autorizado = true;

      }
      return $autorizado;
}	
