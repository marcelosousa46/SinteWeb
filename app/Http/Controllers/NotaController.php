<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\notas;
use App\Models\notaitens;
use App\Models\fpagamentos;
use App\Models\titulos;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;
use App\Classes\Nfe;
use App\Http\Requests\NotaRequest;
use DB;
use App\Classes\InterItens;
use App\Classes\interTitulos;
use App\Classes\nfeConsultar;
use App\Classes\nfeDanfe;
use App\Classes\nfeEmail;
use App\Classes\nfeCancela;

class NotaController extends Controller
{
  private $permissao;
  private $nfe;
  private $inter;
  public function __construct()
  {
      $this->middleware('auth');
      $this->permissao = new Classes;
      $this->inter     = new InterItens;
      $this->iTitulos  = new interTitulos;
      $this->nfe       = new Nfe;
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
      $user_id = session('user_id');
      $retorno = DB::table('notas')
                     ->join('participantes', 'participantes.id', '=', 'notas.participante_id')
                     ->select('notas.id', 'participantes.codigo','participantes.nome','notas.dt_doc',
                              'notas.vl_doc','notas.num_doc','notas.cStat','notas.xMotivo')
                     ->get();

      $notas = collect($retorno);

      return Datatables::of($notas)
      ->addColumn('action', function ($notas) {
      return [
              '<a href="nota/edit/'     .$notas->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="nota/destroy/'  .$notas->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                       onclick="return gerar(\'Excluir Nota?\')"></a>',
              '<a href="nota/geranfe/'  .$notas->id.'" id="gerar" class="glyphicon glyphicon-list-alt" title="Emitir nota"
                                                       onclick="return gerar(\'Emitir nota?\')"></a>',
              '<a href="nota/consultar/'.$notas->id.'" class="glyphicon glyphicon-tasks" title="Consultar"
                                                       onclick="return gerar(\'Consultar recibo?\')"></a>',
              '<a href="nota/danfe/'    .$notas->id.'" class="glyphicon glyphicon-print" title="Danfe"
                                                       onclick="return gerar(\'Gerar danfe?\')"></a>',
              '<a href="nota/email/'    .$notas->id.'" class="glyphicon glyphicon-paste" title="Email"
                                                       onclick="return gerar(\'Enviar email?\')"></a>',
              '<a href="nota/motivo/'   .$notas->id.'" class="glyphicon glyphicon-ban-circle" title="Cancelamento"></a>',
             ];
      })
      ->editColumn('dt_doc', function ($notas) {
                      return date('d/m/Y', strtotime($notas->dt_doc));
                  })      
      ->editColumn('vl_doc', function ($notas) {
                      return number_format($notas->vl_doc, 2, ',', '.');
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
        $formas   = $this->permissao->getFpagamentos();
        return view('notas.notas-new-edit',compact(['rotina_id','user_id','series','unidades','formas']));
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
      // Gravar itens da nota
      for ($i = 0; $i < $request->qtd_item; $i++){
        $itens = $this->inter->relacionar($request, $i);
        $notas->itens()->save($itens);
      }
      // Gravar titulos da nota
      if ($request->ind_pagto == '1'){
        $forma  = fpagamentos::find($request->fpagamento_id);
        $vl_tit = $request->vl_doc / $forma->parcelas;
        for ($i = 1; $i <= $forma->parcelas; $i++){
          $titulos = $this->iTitulos->relacionar($request,$numdoc,$i);
          $titulos->vl_doc = $vl_tit;
          $dias = $i * $forma->intervalo;
          $titulos->dt_venc = date('Y-m-d', strtotime($request->dt_doc. ' + '.$dias.' days'));
          $notas->titulos()->save($titulos);
        }  
      }
      return redirect()->route('nota',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');
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
      $formas     = $this->permissao->getFpagamentos();

      if ($autorizado)
      {
        $nota = notas::find($id);
        return view('notas.notas-new-edit',compact(['nota','rotina_id','user_id','series','unidades','formas']));
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
      $nota      = notas::find($id)->update($request->all());
      $rows      = notaitens::where('notas_id', $request->nota_id)->delete();
      $rows      = titulos::where('notas_id', $request->nota_id)->delete();
      // Gravar itens da nota
      for ($i = 0; $i < $request->qtd_item; $i++){
        $itens = $this->inter->relacionar($request, $i);
        $nota  = notas::find($id)->itens()->save($itens);
      }
      // Gravar titulos da nota
      if ($request->ind_pagto == '1'){
        $forma  = fpagamentos::find($request->fpagamento_id);
        $vl_tit = $request->vl_doc / $forma->parcelas;
        for ($i = 1; $i <= $forma->parcelas; $i++){
          $titulos = $this->iTitulos->relacionar($request,$request->num_doc,$i);
          $titulos->vl_doc = $vl_tit;
          $dias  = $i * $forma->intervalo;
          $titulos->dt_venc = date('Y-m-d', strtotime($request->dt_doc. ' + '.$dias.' days'));
          $nota  = notas::find($id)->titulos()->save($titulos);
        }  
      }
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

  public function anyGeranfe(Request $request, $id)
  {
    $rotina_id = session('rotina_id');
    $user_id   = session('user_id');
    $nota      = notas::find($id);
    if(trim($nota->cStat) != ""){
      session()->put('status', 'error');
      session()->put('status-mensagem', 'Emissão apenas para notas geradas!');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    }

    $error = $this->nfe->getnfe($nota);
    if (!is_array($error)) {
      $nota->cStat   = $error['cStat'];
      $nota->xMotivo = $error['xMotivo'];
      $nota->nRec    = $error['nRec'];
      $nota->save();
      session()->put('status', 'sucesso');
      session()->put('status-mensagem', 'NF-e gerada com sucesso.');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    } else {
      if (isset($error['cStat'])){
        $nota->cStat   = $error['cStat'];
        $nota->xMotivo = $error['xMotivo'];
        $nota->nRec    = $error['nRec'];
        if (isset($error['aProt'][0]['cStat'])){
          $nota->cStat   = $error['aProt'][0]['cStat'];
          $nota->xMotivo = $error['aProt'][0]['xMotivo'];
          $nota->chv_nfe = $error['aProt'][0]['chNFe'];
          $nota->nProt   = $error['aProt'][0]['nProt'];
          if($error['aProt'][0]['cStat'] === '100'){
            session()->put('status', 'sucesso');
            session()->put('status-mensagem', 'NF-e gerada com sucesso.');
          } else {
            session()->put('status', 'error');
            session()->put('status-mensagem', $nota->cStat . ' - '.$nota->xMotivo);
          }
        }  
        $nota->save();
        return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        return view('notas.notas-errors',compact(['nota','error','rotina_id','user_id']));
      }  
    }

  }

  public function anyConsultar(Request $request, $id){
    $rotina_id = session('rotina_id');
    $user_id   = session('user_id');
    $nota      = notas::find($id);

    if(trim($nota->nRec) === ""){
      session()->put('status', 'error');
      session()->put('status-mensagem', 'Consultar nota apenas para notas enviadas para sefaz!');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    } elseif(trim($nota->cStat) === "100"){
      session()->put('status', 'error');
      session()->put('status-mensagem', 'Nota já autorizada o uso!');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    }

    $consulta  = new nfeConsultar;
    $resposta  = $consulta->getConsulta($nota->nRec,'2');

    if (isset($resposta['cStat'])){
      $nota->cStat   = $resposta['aProt'][0]['cStat'];
      $nota->xMotivo = $resposta['aProt'][0]['xMotivo'];
      $nota->chv_nfe = $resposta['aProt'][0]['chNFe'];
      $nota->save();
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    }
  }

  public function anyDanfe(Request $request, $id){
    $rotina_id = session('rotina_id');
    $user_id   = session('user_id');
    $nota      = notas::find($id);

    if(trim($nota->cStat) != "100"){
      session()->put('status', 'error');
      session()->put('status-mensagem', 'Gerar danfe apenas para notas autorizadas!');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    }

    $consulta  = new nfeDanfe;
    $resposta  = $consulta->getDanfe($nota,$nota->chv_nfe,true);

  }

  public function anyEmail(Request $request, $id){
    $rotina_id = session('rotina_id');
    $user_id   = session('user_id');
    $nota      = notas::find($id);

    if(trim($nota->cStat) != "100"){
      session()->put('status', 'error');
      session()->put('status-mensagem', 'Enviar e-mail apenas para notas autorizadas!');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    }

    $email     = new nfeEmail;
    $resposta  = $email->getEmail($nota,$nota->chv_nfe);
    if ($resposta){
      session()->put('status', 'sucesso');
      session()->put('status-mensagem', 'E-mail enviado com sucesso.');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    } else {
      session()->put('status', 'error');
      session()->put('status-mensagem', 'Problema no envio do e-mail.');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    }

  }
  public function anyCancela(Request $request, $id){
    $rotina_id = session('rotina_id');
    $user_id   = session('user_id');
    $xJust     = $request->motivo;
    $nota      = notas::find($id);

    if(trim($nota->cStat) != "100"){
      session()->put('status', 'error');
      session()->put('status-mensagem', 'Cancelamento apenas para notas autorizadas!');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    }

    $cancelamento = new nfeCancela;
    $resposta     = $cancelamento->getCancela($nota,$xJust);
    if ($resposta['evento'][0]['cStat']==='135'){
      $nota->cStat   = $resposta['evento'][0]['cStat'];
      $nota->xMotivo = $resposta['evento'][0]['xMotivo'];
      $nota->save();
      session()->put('status', 'sucesso');
      session()->put('status-mensagem', 'Nota cancelada com sucesso.');
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    } else {
      session()->put('status', 'error');
      session()->put('status-mensagem', $resposta['evento'][0]['xMotivo']);
      return redirect()->route('nota', ['id' => $rotina_id, 'user_id'=>$user_id]);
    }

  }

  public function anyMotivo(Request $request, $id){
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $nota = notas::find($id);
        return view('notas.notas-cancelamento',compact(['nota','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('notas.notas',compact(['nota','rotina_id','user_id']));
      }

  }
}
