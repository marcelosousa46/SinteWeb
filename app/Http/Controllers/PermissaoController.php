<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Permissoes;
use App\Models\Rotinas;

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
      return Datatables::of(Permissoes::all())

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
      return view('permissoes.permissoes-new-edit',compact('rotina_id'));
  }

  public function postStore(Request $request)
  {
      $input = $request->all();
      Permissoes::create($input);

      return redirect()->route('permissoes', ['id' => session('rotina_id')]);

  }

  public function getDestroy($id)
  {
      Permissoes::find($id)->delete();

      return redirect()->route('permissoes', ['id' => session('rotina_id')]);
  }

  public function getEdit(Request $request,$id)
  {
     $autorizacao = 'B';
     if ($request->session()->has('rotina_id')) {
        $crud = auth()->user()->Crud(session('rotina_id'));
        $autorizacao = $crud[0]->alterar;
      }
      $this->validate($request, [
              'usuario' => "in:$autorizacao,'A'",
          ]);

      if ($autorizacao == 'A'){
        $permissao = Permissoes::find($id);
        $username  = auth()->user()->name;
        $rotina_id = session('rotina_id');
        $rotinadescricao = Rotinas::find($id)->descricao;
        return view('permissoes.permissoes-new-edit', compact(['permissao','rotina_id','username','rotinadescricao']));
      } else {
        session()->put('status', 'Usuário não autorizado.');
        return redirect()->route('permissoes', ['id' => session('rotina_id')]);
      }
  }


  public function postUpdate(Request $request, $id)
  {
      $Permissoes = Permissoes::find($id)->update($request->all());

      return redirect()->route('permissoes', ['id' => session('rotina_id')]);
  }

}
