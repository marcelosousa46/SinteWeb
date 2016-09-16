<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Participantes;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;
use App\Http\Requests\ParticipanteRequest;

class ParticipanteController extends Controller
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

      return view('participantes.participantes', compact(['rotina_id','user_id']));
  }
  public function anyData()
  {
      $user_id  = session('user_id');
      $participantes = Participantes::all();

      return Datatables::of($participantes)

      ->addColumn('action', function ($participantes) {
      return [
              '<a href="participante/edit/'.$participantes->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="participante/destroy/'.$participantes->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                                     onclick="return confirm(\'Excluir Participante?\')"></a>',
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
        return view('participantes.participantes-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('participantes.participantes',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }
  public function postStore(ParticipanteRequest $request)
  { 
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();

      Participantes::create($input);
      return redirect()->route('participante',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Participantes::find($id)->delete();
        return redirect()->route('participante', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('participantes.participantes',compact(['rotina_id','user_id']));
      }
  }
  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $participante = Participantes::find($id);
        return view('participantes.participantes-new-edit',compact(['participante','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('participantes.participantes',compact(['participante','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $participante    = Participantes::find($id)->update($request->all());

      return redirect()->route('participante', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function anyNome(Request $request)
  {
      $data = Participantes::select("codigo","nome as name","id")->where("nome","LIKE","%{$request->input('query')}%")->get();
      return response()->json($data);
  }
  public function anyCodigo(Request $request)
  {
      $data = Participantes::select("codigo as name","nome","id")->where("codigo","LIKE","%{$request->input('query')}%")->get();
      return response()->json($data);
  }  
}
