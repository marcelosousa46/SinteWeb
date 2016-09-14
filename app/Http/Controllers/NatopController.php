<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Natops;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;


class NatopController extends Controller
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

      return view('natops.natops', compact(['rotina_id','user_id']));
  }
  public function anyData()
  {
      $user_id  = session('user_id');
      $natops = Natops::all();

      return Datatables::of($natops)

      ->addColumn('action', function ($natops) {
      return [
              '<a href="natop/edit/'.$natops->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="natop/destroy/'.$natops->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir Natureza da operação?\')"></a>',
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
        return view('natops.natops-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('natops.natops',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }
  public function postStore(Request $request)
  { 
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();

      Natops::create($input);
      return redirect()->route('natop',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Natops::find($id)->delete();
        return redirect()->route('natop', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('natops.natops',compact(['rotina_id','user_id']));
      }
  }
  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $natop = Natops::find($id);
        return view('natops.natops-new-edit',compact(['natop','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('natops.natops',compact(['natop','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $natops    = Natops::find($id)->update($request->all());

      return redirect()->route('natop', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function anyAutocomplete(Request $request)
  {
      $data = Natops::select("codigo","descricao as name","id")->where("descricao","LIKE","%{$request->input('query')}%")->get();
      return response()->json($data);
  }
  public function anyCodigo(Request $request)
  {
      $data = Natops::select("codigo as name","descricao","id")->where("codigo","LIKE","%{$request->input('query')}%")->get();
      return response()->json($data);
  }
  public function anyId(Request $request, $id)
  {
      $data = Natops::find($id);
      return response()->json($data);
  }

}
