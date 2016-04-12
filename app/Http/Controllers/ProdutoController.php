<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Produtos;
use App\Classes\Classes;
use Yajra\Datatables\Datatables;


class ProdutoController extends Controller
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

      return view('produtos.produtos', compact(['rotina_id','user_id']));
  }

  public function anyData()
  {
      $user_id  = session('user_id');
      $produtos = Produtos::all();

      return Datatables::of($produtos)

      ->addColumn('action', function ($produtos) {
      return [
              '<a href="produtos/edit/'.$produtos->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="produtos/destroy/'.$produtos->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir produto?\')"></a>',
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
        return view('produtos.produtos-new-edit',compact(['rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('produtos.produtos',compact(['permissao','rotina_id','user_id','username','rotinadescricao']));
      }
  }

  public function postStore(Request $request)
  { 

      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $input = $request->all();

      Produtos::create($input);
      return redirect()->route('produtos',['id' => $rotina_id, 'user_id'=>$user_id]);

  }

  public function getDestroy(Request $request,$id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $autorizado = $this->permissao->getPermissao($request,'E');

      if ($autorizado)
      {
        Produtos::find($id)->delete();
        return redirect()->route('produtos', ['id' => $rotina_id, 'user_id'=>$user_id]);
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('produtos.produtos',compact(['rotina_id','user_id']));
      }
  }

  public function getEdit(Request $request,$id)
  {
      $autorizado = $this->permissao->getPermissao($request,'A');
      $rotina_id  = session('rotina_id');
      $user_id    = session('user_id');

      if ($autorizado)
      {
        $produto = produtos::find($id);
        return view('produtos.produtos-new-edit',compact(['produto','rotina_id','user_id']));
      } else {
        session()->put('status', 'error');
        session()->put('status-mensagem', 'Usuário não autorizado.');
        return view('produtos.produtos',compact(['produto','rotina_id','user_id']));
      }
  }

  public function postUpdate(Request $request, $id)
  {
      $rotina_id = session('rotina_id');
      $user_id   = session('user_id');
      $request->input('preco', '1711.20');
      dd($request->all());
      $Produtos = produtos::find($id)->update($request->all());

      return redirect()->route('produtos', ['id' => $rotina_id, 'user_id'=>$user_id]);
  }

}
