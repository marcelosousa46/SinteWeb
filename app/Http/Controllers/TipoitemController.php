<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Tipoitens;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;

class TipoitemController extends Controller
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

      return view('tipoitens.tipoitens', compact(['rotina_id','user_id']));
  }
  public function anyData()
  {
      $user_id   = session('user_id');
      $tipoitens = Tipoitens::all();

      return Datatables::of($tipoitens)

      ->addColumn('action', function ($tipoitens) {
      return [
              '<a href="tipoitens/edit/'.$tipoitens->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="tipoitens/destroy/'.$tipoitens->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                              onclick="return confirm(\'Excluir tipo do item?\')"></a>',
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
        return view('tipoitens.tipoitens-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('tipoitens.tipoitens',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }
  public function postStore(Request $request)
  { 
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input     = $request->all();

      Tipoitens::create($input);
      return redirect()->route('tipoitens',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Tipoitens::find($id)->delete();
        return redirect()->route('tipoitens', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('tipoitens.tipoitens',compact(['rotina_id','user_id']));
      }
  }
  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $tipoitem = Tipoitens::find($id);
        return view('tipoitens.tipoitens-new-edit',compact(['tipoitem','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('tipoitens.tipoitens',compact(['tipoitem','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $tipoitem  = Tipoitens::find($id)->update($request->all());

      return redirect()->route('tipoitem', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }
}
