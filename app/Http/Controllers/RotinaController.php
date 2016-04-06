<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\Models\Rotinas;
use App\User;

class RotinaController extends Controller
{
	private $var;
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getIndex(Request $request)
  {
      $query = ($request->query());
      $request->session()->put('rotina_id', $query['id']);
      return view('rotinas.rotinas');
  }

  public function anyData()
  {
      return Datatables::of(Rotinas::all())

      ->addColumn('action', function ($rotinas) {
      return [
              '<a href="rotinas/edit/'.$rotinas->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="rotinas/destroy/'.$rotinas->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir rotina?\')"></a>',
							'<a href="permissoes/create/'.$rotinas->id.'" class="glyphicon glyphicon-th-list" title="Permissões"></a>'
             ];
      })
      ->make(true);
  }

	public function getCreate()
  {
      return view('rotinas.rotinas-new-edit');
  }

}
