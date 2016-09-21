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

class NotaController extends Controller
{
  private $permissao;
  private $nfe;
  public function __construct()
  {
      $this->middleware('auth');
      $this->permissao = new Classes;
//      $this->nfe = new Nfe;
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
      //dd($input);
      $notas = Notas::create($input);
      $i = 0;
      for ($i = 0; $i < $request->qtd_item; $i++){
        $itens = new notaitens([
          'num_item'      => $i + 1,
          'produtos_id'   => $request->item_id_item[$i],
          'qtd'           => $request->item_qtd[$i],
          'unid'          => 'UND',
          'vl_item'       => $request->item_vl_item[$i], 
          'vl_desc'       => 0,
          'ind_mov'       => '',
          'cst_icms'      => $request->item_cst[$i], 
          'natop_id'      => $request->item_id_natop[$i], 
          'cod_nat'       => '',
          'vl_bc_icms'    => $request->item_vl_merc[$i],
          'aliq_icms'     => $request->item_icms[$i],
          'vl_icms'       => $request->item_vl_icms[$i],
          'vl_bc_icms_ST' => 0,
          'aliq_ST'       => 0,
          'vl_icms_st'    => 0,
          'ind_apur'      => '0',
          'cst_ipi'       => '02',
          'cod_enq'       => '',
          'vl_bc_ipi'     => 0,
          'aliq_ipi'      => 0,
          'vl_ipi'        => 0,
          'cst_pis'       => '03',
          'vl_bc_pis'     => $request->item_vl_merc[$i],
          'aliq_pis'      => $request->item_pis[$i],
          'quant_bc_pis'  => '',
          'vl_pis'        => $request->item_vl_pis[$i],
          'cst_cofins'    => '03',
          'vl_bc_cofins'  => $request->item_vl_merc[$i],
          'aliq_cofins'   => $request->item_cofins[$i],
          'quant_bc_pis'  => '',
          'vl_cofins'     => $request->item_vl_cofins[$i],
          'cod_conta'     => ''
        ]);
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
      $series     = $this->permissao->getSeries();
      $unidades   = $this->permissao->getUnidades();

      if ($autorizado)
      {
        $nota = Notas::find($id);
        return view('notas.notas-new-edit',compact(['nota','rotina_id','user_id','series','unidades']));
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
