<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\notas;
use App\Models\notasitens;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;
use App\Classes\Nfe;
use App\Http\Requests\NotaRequest;

class NotaController extends Controller
{
  private $permissao;
  private $nfe;
  public function __construct()
  {
      $this->middleware('auth');
      $this->permissao = new Classes;
      $this->nfe = new Nfe;
  }
  public function getIndex(Request $request)
  {
      $query = ($request->query());
      $request->session()->put('rotina_id', $query['id']);
      $rotina_id = session('rotina_id');
      $request->session()->put('user_id', $query['user_id']);
      $user_id = session('user_id');

      return view('notas.notas', compact(['rotina_id','user_id']));
  }
  public function anyData()
  {
      $user_id  = session('user_id');
      $notas = Notas::all();

      return Datatables::of($notas)

      ->addColumn('action', function ($notas) {
      return [
              '<a href="nota/edit/'.$notas->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="nota/destroy/'.$notas->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                                     onclick="return confirm(\'Excluir Nota?\')"></a>',
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
        $series   = $this->permissao->getSeries();
        $unidades = $this->permissao->getUnidades();
        return view('notas.notas-new-edit',compact(['rotina_id','user_id','series','unidades']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('notas.notas',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }
  public function postStore(NotaRequest $request)
  { 
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();
      dd($input);
      Notas::create($input);
      $itens = notaitens::find($id);
        foreach ($postValues['qty'] as $qty) {

        $itens->create([ 
            'id' => $order->id,
            'total' => $qty,
        ]);
    }
      return redirect()->route('nota',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Notas::find($id)->delete();
        return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('notas.notas',compact(['rotina_id','user_id']));
      }
  }
  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $nota = Notas::find($id);
        return view('notas.notas-new-edit',compact(['nota','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('notas.notas',compact(['nota','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $nota      = Notas::find($id)->update($request->all());

      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

  public function anyGeranfe(Request $request)
  {
    return $this->nfe->getnfe($request);
  }

}
