<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class PermissaoController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getIndex(Request $request)
  {
      $query = ($request->query());
      $request->session()->put('rotina_id', $query['id']);
      return view('permissoes.permissoes');
  }

  public function anyData()
  {
      $rotinas = auth()->user()->Rotinas();
      $json = '[{';
      foreach ($rotinas as $ro){
         $menu = '"text":'.'"'.$ro->descricao.'"'.',';
         $subrotinas  = auth()->user()->Subrotinas($ro->nivel);
         $submenu = '"nodes": [';
         foreach ($subrotinas as $su){
            $submenu = $submenu .'{'.'"text": "'.$su->descricao.'"'.'},';
         }
         $submenu = substr($submenu,0,-1).']';
      }
      return $json.$menu.$submenu.'}]';

  }

}
