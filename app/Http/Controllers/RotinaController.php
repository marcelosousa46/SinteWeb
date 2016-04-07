<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\Models\Rotinas;
use App\User;

class RotinaController extends Controller
{
  private $user_id;
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getIndex(Request $request)
  {
      $query = ($request->query());
      $request->session()->put('rotina_id', $query['id']);
			$rotina_id = session('rotina_id');
      $this->user_id = $query['user_id'];

      return view('rotinas.rotinas', compact('rotina_id'));
  }

  public function anyData()
  {
//      $linhas = DB::table('users')
//                ->join('permissoes', 'permissoes.users_id', '=', 'users.id')
//                ->join('rotinas', 'rotinas.id', '=', 'permissoes.rotinas_id')
//                ->select(['rotinas.descricao','rotinas.tipo','rotinas.mivel'])
//                ->where('users.id', $this->user_id)
//                ->get();
      $linhas = Rotinas::all();
      return Datatables::of($linhas)

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

	public function getCreate()
  {
  		$rotina_id = session('rotina_id');
      return view('rotinas.rotinas-new-edit',compact('rotina_id'));
  }

  public function postStore(Request $request)
  {
      $input = $request->all();
      Rotinas::create($input);

      return redirect()->route('rotinas', ['id' => session('rotina_id')]);

  }

  public function getDestroy($id)
  {
      Rotinas::find($id)->delete();

      return redirect()->route('rotinas', ['id' => session('rotina_id')]);
  }

  public function getEdit(Request $request,$id)
  {
     $permissao = 'B';
     if ($request->session()->has('rotina_id')) {
        $crud = auth()->user()->Crud(session('rotina_id'));
        $permissao = $crud[0]->alterar;
      }
      $this->validate($request, [
              'usuario' => "in:$permissao,'A'",
          ]);

      if ($permissao == 'A'){
        $rotina = Rotinas::find($id);
        $rotina_id = session('rotina_id');
        return view('rotinas.rotinas-new-edit', compact(['rotina','rotina_id']));
      } else {
        session()->put('status', 'Usuário não autorizado.');
        return redirect()->route('rotinas', ['id' => session('rotina_id')]);
      }
  }


  public function postUpdate(Request $request, $id)
  {
      $setor = Rotinas::find($id)->update($request->all());

      return redirect()->route('rotinas', ['id' => session('rotina_id')]);
  }

}
