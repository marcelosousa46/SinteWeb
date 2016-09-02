<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Notas;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;

class NotaController extends Controller
{
  private $permissao;
  public function __construct()
  {
      $this->middleware('auth');
      $this->permissao = new Classes;
  }
  public function getIndex(Request $request)
  {
      $query = ($request->query());
      $request->session()->put('rotina_id', $query['id']);
      $rotina_id = session('rotina_id');
      $request->session()->put('user_id', $query['user_id']);
      $user_id = session('user_id');

      return view('notas.notas', compact(['rotina_id','user_id']));
  }
  public function anyData()
  {
      $user_id  = session('user_id');
      $notas = Notas::all();

      return Datatables::of($notas)

      ->addColumn('action', function ($notas) {
      return [
              '<a href="nota/edit/'.$notas->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="nota/destroy/'.$notas->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                                     onclick="return confirm(\'Excluir Nota?\')"></a>',
             ];
      })
      ->make(true);
  }  
  public function getCreate(Request $request)
  {
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'I');
      if ($autorizado)
      {
        return view('notas.notas-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('notas.notas',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }
  public function postStore(ParticipanteRequest $request)
  { 
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();

      Notas::create($input);
      return redirect()->route('nota',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Notas::find($id)->delete();
        return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('notas.notas',compact(['rotina_id','user_id']));
      }
  }
  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $nota = Notas::find($id);
        return view('notas.notas-new-edit',compact(['nota','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('notas.notas',compact(['nota','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $nota    = Notas::find($id)->update($request->all());

      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

}
