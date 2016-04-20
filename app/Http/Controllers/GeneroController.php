<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Generos;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;

class GeneroController extends Controller
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

      return view('generos.generos', compact(['rotina_id','user_id']));
  }
  public function anyData()
  {
      $user_id  = session('user_id');
      $generos = Generos::all();

      return Datatables::of($generos)

      ->addColumn('action', function ($generos) {
      return [
              '<a href="generos/edit/'.$generos->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="generos/destroy/'.$generos->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir genero?\')"></a>',
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
        return view('generos.generos-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('generos.generos',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }
  public function postStore(Request $request)
  { 
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();

      Generos::create($input);
      return redirect()->route('generos',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Generos::find($id)->delete();
        return redirect()->route('generos', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('generos.generos',compact(['rotina_id','user_id']));
      }
  }
  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $genero = Generos::find($id);
        return view('generos.generos-new-edit',compact(['genero','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('generos.generos',compact(['genero','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $genero    = Generos::find($id)->update($request->all());

      return redirect()->route('unidades', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }
}
