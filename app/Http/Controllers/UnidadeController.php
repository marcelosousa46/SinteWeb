<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Unidades;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;


class UnidadeController extends Controller
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

      return view('unidades.unidades', compact(['rotina_id','user_id']));
  }
  public function anyData()
  {
      $user_id  = session('user_id');
      $unidades = Unidades::all();

      return Datatables::of($unidades)

      ->addColumn('action', function ($unidades) {
      return [
              '<a href="unidades/edit/'.$unidades->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="unidades/destroy/'.$unidades->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir unidade?\')"></a>',
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
        return view('unidades.unidades-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('unidades.unidades',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }
  public function postStore(Request $request)
  { 
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();

      Unidades::create($input);
      return redirect()->route('unidades',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Unidades::find($id)->delete();
        return redirect()->route('unidades', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('unidades.unidades',compact(['rotina_id','user_id']));
      }
  }
  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $unidade = Unidades::find($id);
        return view('unidades.unidades-new-edit',compact(['unidade','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('unidades.unidades',compact(['unidade','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $valor     = $this->permissao->getValor($request->input('preco'));
      $request->merge(array('preco' => $valor));
      $unidades = Unidades::find($id)->update($request->all());

      return redirect()->route('unidades', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

}
