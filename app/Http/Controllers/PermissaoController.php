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
      $rotina_id = session('rotina_id');
      $request->session()->put('user_id', $query['user_id']);

      return view('permissoes.permissoes', compact('rotina_id'));
  }

  public function anyData()
  {
      $user_id = session('user_id');
      $retorno = DB::table('permissoes')
                     ->join('rotinas', 'rotinas.id', '=', 'permissoes.rotinas_id')
                     ->join('users', 'users.id', '=', 'permissoes.users_id')
                     ->select(['permissoes.id','rotinas.descricao','permissoes.liberado','permissoes.incluir','permissoes.alterar',
                               'permissoes.consultar','permissoes.excluir', 'permissoes.rotinas_id'])
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

  public function getCreate()
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      return view('permissoes.permissoes-new-edit',compact(['rotina_id','user_id']));
  }

  public function postStore(Request $request)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');

      $input = $request->all();
      Permissoes::create($input);

      return redirect()->route('permissoes',['id' => $rotina_id, 'user_id'=>$user_id]);

  }

  public function getDestroy($id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');

      Permissoes::find($id)->delete();

      return redirect()->route('permissoes', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

  public function getEdit(Request $request,$id)
  {
//     $autorizacao = 'B';
//     if ($request->session()->has('rotina_id')) {
//        $crud = auth()->user()->Crud(session('rotina_id'));
//        $autorizacao = $crud[0]->alterar;
//      }
//      $this->validate($request, [
//              'usuario' => "in:$autorizacao,'A'",
//          ]);

//      if ($autorizacao == 'A'){
//        $permissao = Permissoes::find($id);
//        $username  = auth()->user()->name;
//        $rotina_id = session('rotina_id');
//        $user_id   = session('user_id');
      if getPermissao($request)
      {  
        $rotinadescricao = Rotinas::find($id)->descricao;
        return view('permissoes.permissoes-new-edit', compact(['permissao','rotina_id','username','rotinadescricao']));
      } else {
        session()->put('status', 'Usuário não autorizado.');
        return redirect()->route('permissoes', ['id' => $rotina_id, 'user_id'=>$user_id]);
      }

  }


  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');

      $Permissoes = Permissoes::find($id)->update($request->all());

      return redirect()->route('permissoes', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

}
