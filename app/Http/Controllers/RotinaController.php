<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\Models\Rotinas;
use App\User;
use DB;
use App\Classes\Classes;

class RotinaController extends Controller
{
  private $user_id;
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

      return view('rotinas.rotinas', compact(['rotina_id','user_id']));
  }

  public function anyData()
  {
      $user_id = session('user_id');
      $retorno = DB::table('users')
                     ->join('permissoes', 'permissoes.users_id', '=', 'users.id')
                     ->join('rotinas', 'rotinas.id', '=', 'permissoes.rotinas_id')
                     ->select(['rotinas.id','rotinas.descricao','rotinas.tipo','rotinas.nivel'])
                     ->where('users.id', $user_id)
                     ->get();

      $rotina = collect($retorno);

      return Datatables::of($rotina)

      ->addColumn('action', function ($rotinas) {
      return [
              '<a href="rotinas/edit/'.$rotinas->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="rotinas/destroy/'.$rotinas->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir rotina?\')"></a>',
							'<a href="permissoes/edit/'.$rotinas->id.'" class="glyphicon glyphicon-th-list" title="Permissões"></a>'
             ];
      })
      ->make(true);
  }

	public function getCreate(Request $request)
  {
  	$rotina_id = session('rotina_id');
    $user_id   = session('user_id');

    $autorizado = $this->permissao->getPermissao($request,'I');
    if ($autorizado){
      return view('rotinas.rotinas-new-edit',compact(['rotina_id','user_id']));
    } else {
      session()->put('status', 'error');
      session()->put('status-mensagem', 'Usuário não autorizado.');
      session()->put('status', 'Usuário não autorizado.');
      return redirect()->route('rotinas', ['id' => session('rotina_id'),'user_id' => session('user_id')]);
    }
  }

  public function postStore(Request $request)
  {
      $input = $request->all();
      Rotinas::create($input);

      return redirect()->route('rotinas', ['id' => session('rotina_id'),'user_id' => session('user_id') ]);

  }

  public function getDestroy(Request $request,$id)
  {
    $rotina_id  = session('rotina_id');
    $user_id    = session('user_id');
    $autorizado = $this->permissao->getPermissao($request,'E');
    if ($autorizado){
       Rotinas::find($id)->delete();
      return redirect()->route('rotinas', ['id' => session('rotina_id'),'user_id' => session('user_id')]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return redirect()->route('rotinas', ['id' => session('rotina_id'),'user_id' => session('user_id')]);
      }
  }

  public function getEdit(Request $request,$id)
  {
     $autorizado = $this->permissao->getPermissao($request,'A');

      if ($autorizado){
        $rotina = Rotinas::find($id);
        $rotina_id = session('rotina_id');
        $user_id = session('user_id');
        return view('rotinas.rotinas-new-edit', compact(['rotina','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return redirect()->route('rotinas', ['id' => session('rotina_id'),'user_id']);
      }
  }


  public function postUpdate(Request $request, $id)
  {
      $setor = Rotinas::find($id)->update($request->all());

      return redirect()->route('rotinas', ['id' => session('rotina_id'),'user_id' => session('user_id')]);
  }

}
