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
      $subrotinas  = auth()->user()->Subrotinas($rotinas[0]->nivel);
      $json = '[{';
      $item = '';
      foreach ($rotinas as $ro){
         $menu = '"text":';
         $menu = $menu.'"'.$ro->descricao.'"'.',';
         $submenu = '"nodes": [';
         foreach ($subrotinas as $su){
            if ($su->nivel == $ro->nivel){
               $submenu = $submenu .'{'.'"text": "'.$su->descricao.'"'.'},';
            }   
         }
         $submenu = substr($submenu,0,-1).']';
         $item = $item.$menu.$submenu;
      }
      return $json.$item.'}]';

  }

}
