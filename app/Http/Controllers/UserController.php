<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\User;

class UserController extends Controller
{
  private $var;
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getIndex(Request $request)
  {
      $query = ($request->query());
      $request->session()->put('rotina_id', $query['id']);
      $rotina_id = session('rotina_id');

      return view('usuarios.usuarios', compact('rotina_id'));
  }

  public function anyData()
  {
      return Datatables::of(User::all())

      ->addColumn('action', function ($usuarios) {
      return [
              '<a href="usuarios/edit/'.$usuarios->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="usuarios/destroy/'.$usuarios->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir usuario?\')"></a>',
              '<a href="/rotinas?id='.session('rotina_id').'&user_id='.$usuarios->id. '" class="glyphicon glyphicon-th-list" title="Permissões"></a>'

             ];
      })
      ->make(true);
  }

  public function getCreate()
  {
      return view('usuarios.usuarios-new-edit');
      return view('usuarios.usuarios-new-edit',compact('rotina_id'));
  }

  public function postStore(Request $request)
  {
      $input = $request->all();
      User::create($input);

      return redirect()->route('usuarios', ['id' => session('rotina_id')]);

  }

  public function getDestroy($id)
  {
      User::find($id)->delete();

      return redirect()->route('usuarios', ['id' => session('rotina_id')]);
  }

  public function getEdit(Request $request,$id)
  {
     $permissao = 'B';
     if ($request->session()->has('rotina_id')) {
        $crud = auth()->user()->Crud(session('rotina_id'));
        $permissao = substr($crud[0]->crud,1,1);
      }
      $this->validate($request, [
              'usuario' => "in:$permissao,'A'",
          ]);

      if ($permissao == 'A'){
        $usuario = User::find($id);
        $rotina_id = session('rotina_id');
        return view('usuarios.usuarios-new-edit', compact(['usuario','rotina_id']));
      } else {
        session()->put('status', 'Usuário não autorizado.');
        return redirect()->route('usuarios', ['id' => session('rotina_id')]);
      }
  }


  public function postUpdate(Request $request, $id)
  {
      $setor = User::find($id)->update($request->all());

      return redirect()->route('usuarios', ['id' => session('rotina_id')]);
  }
}
