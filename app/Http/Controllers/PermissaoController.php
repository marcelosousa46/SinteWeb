<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Permissoes;
use App\Models\Rotinas;
use Yajra\Datatables\Datatables;
use DB;
use App\Classes\Classes;
use App\Http\Requests\PermissaoRequest;

class PermissaoController extends Controller
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

      return view('permissoes.permissoes', compact(['rotina_id','user_id']));
  }

  public function anyData()
  {
      $user_id = session('user_id');
      $retorno = DB::table('permissoes')
                     ->join('rotinas', 'rotinas.id', '=', 'permissoes.rotinas_id')
                     ->join('users', 'users.id', '=', 'permissoes.users_id')
                     ->select(['permissoes.id', 'permissoes.users_id','rotinas.descricao','permissoes.liberado','permissoes.incluir','permissoes.alterar',
                               'permissoes.consultar','permissoes.excluir', 'permissoes.rotinas_id','users.name'])
                     ->where('permissoes.users_id', $user_id)
                     ->get();

      $permissoes = collect($retorno);

      return Datatables::of($permissoes)

      ->addColumn('action', function ($permissoes) {
      return [
              '<a href="permissoes/edit/'.$permissoes->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="permissoes/destroy/'.$permissoes->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir pemissões?\')"></a>',
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
        return view('permissoes.permissoes-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('permissoes.permissoes',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }

  public function postStore(PermissaoRequest $request)
  { 

      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();

      Permissoes::create($input);
      return redirect()->route('permissoes',['id' => $rotina_id, 'user_id'=>$user_id]);



  }

  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Permissoes::find($id)->delete();
        return redirect()->route('permissoes', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('permissoes.permissoes',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }

  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $rotinadescricao = Rotinas::find($id)->descricao;
        $username  = User::find($user_id)->name;
        $permissao = Permissoes::find($id);
        return view('permissoes.permissoes-new-edit',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('permissoes.permissoes',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }

  }


  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');

      $Permissoes = Permissoes::find($id)->update($request->all());

      return redirect()->route('permissoes', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

  public function gerar(Request $request)
  {
      $autorizado = $this->permissao->getPermissao($request);
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      $gerado = $this->permissao->gerarPermissoes(session('user_id'));

      if ($gerado)
      {
        session()->put('status', 'sucesso');
        session()->put('status-mensagem', 'Permissoes geradas com sucesso.');
        return view('permissoes.permissoes',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'permissões não geradas.');
        return view('permissoes.permissoes',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }

}
