<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Classes\Classes;
use App\Models\fpagamentos;


class FpagamentoController extends Controller
{
  private $permissao;
  public function __construct()
  {
      $this->middleware('auth');
      $this->classe = new Classes;
  }

  public function anyData()
  {
      $user_id  = session('user_id');
      $formas   = Fpagamentos::all();

      return Datatables::of($formas)

      ->addColumn('action', function ($formas) {
      return [
              '<a href="fpagamento/edit/'.$formas->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="fpagamento/destroy/'.$formas->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir forma de pagamento?\')"></a>',
             ];
      })
      ->make(true);
  }

  public function anyFormas(Request $request)
  {
      return $this->classe->getFpagamentos();
  }
}
