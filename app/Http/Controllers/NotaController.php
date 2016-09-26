<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\notas;
use App\Models\notaitens;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;
use App\Classes\Nfe;
use App\Http\Requests\NotaRequest;
use DB;
use App\Classes\InterItens;

class NotaController extends Controller
{
  private $permissao;
  private $nfe;
  private $inter;
  public function __construct()
  {
      $this->middleware('auth');
      $this->permissao = new Classes;
      $this->inter = new InterItens;
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
      $retorno = DB::table('notas')
                     ->join('participantes', 'participantes.id', '=', 'notas.participante_id')
                     ->select('notas.id', 'participantes.codigo','participantes.nome','notas.dt_doc','notas.vl_doc')
                     ->get();

      $notas = collect($retorno);

      return Datatables::of($notas)

      ->addColumn('action', function ($notas) {
      return [
              '<a href="nota/edit/'.$notas->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="nota/destroy/'.$notas->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                                     onclick="return confirm(\'Excluir Nota?\')"></a>',
              '<a href="nota/geranfe/'.$notas->id.'" class="glyphicon glyphicon-list-alt" title="Emitir nota"
                                                                     onclick="return confirm(\'Confirma emissão da nota?\')"></a>',
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
      $numdoc    = $this->permissao->numeroNota($request->ser);
      $request->merge(array('num_doc' => $numdoc));
      $request->merge(array('dt_e_s'  => $request->dt_doc));
      $input     = $request->all();
      $notas     = notas::create($input);
      $i = 0;
      for ($i = 0; $i < $request->qtd_item; $i++){
        $itens = $this->inter->relacionar($request, $i);
        $notas->itens()->save($itens);
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
        notas::find($id)->delete();
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
      $series     = $this->permissao->getSeries();
      $unidades   = $this->permissao->getUnidades();

      if ($autorizado)
      {
        $nota = notas::find($id);
//        dd($nota->itens->count());
        return view('notas.notas-new-edit',compact(['nota','rotina_id','user_id','series','unidades']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('notas.notas',compact(['nota','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
//      dd($request->all());
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $nota      = notas::find($id)->update($request->all());
      $rows      = notaitens::where('notas_id', $request->nota_id)->delete();
      $i = 0;
      for ($i = 0; $i < $request->qtd_item; $i++){
        $itens = $this->inter->relacionar($request, $i);
        $nota  = notas::find($id)->itens()->save($itens);
      }
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

  public function anyGeranfe(Request $request, $id)
  {
    $rotina_id = session('rotina_id');
    $user_id   = session('user_id');
    $nota      = notas::find($id);
    $error     = $this->nfe->getnfe($nota);
    $rejeicao  = false;
    if (!is_array($error)) {
      session()->put('status', 'sucesso');
      session()->put('status-mensagem', 'NF-e gerada com sucesso.');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    } else {
      $rejeicao = true;
      return view('notas.notas-errors',compact(['rejeicao','error','rotina_id','user_id']));
    }

  }

}
