<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Ncms;
Use App\Classes\Classes;
use Yajra\Datatables\Datatables;

class NcmController extends Controller
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

      return view('ncms.ncms', compact(['rotina_id','user_id']));
  }
  public function anyData()
  {
      $user_id  = session('user_id');
      $generos = Ncms::all();

      return Datatables::of($ncms)

      ->addColumn('action', function ($ncms) {
      return [
              '<a href="ncms/edit/'.$ncms->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="ncms/destroy/'.$ncms->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir N.C.M?\')"></a>',
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
        return view('ncms.ncms-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('ncms.ncms',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }
  public function postStore(Request $request)
  { 
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();

      Ncms::create($input);
      return redirect()->route('ncms',['id' => $rotina_id, 'user_id'=>$user_id]);
  }
  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Ncms::find($id)->delete();
        return redirect()->route('ncms', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('ncms.ncms',compact(['rotina_id','user_id']));
      }
  }
  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $ncm = Ncms::find($id);
        return view('ncms.ncms-new-edit',compact(['ncm','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('ncms.ncms',compact(['ncm','rotina_id','user_id']));
      }
  }
  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $ncm       = Ncms::find($id)->update($request->all());

      return redirect()->route('ncms', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

}
