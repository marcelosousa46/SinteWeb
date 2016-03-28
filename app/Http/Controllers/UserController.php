<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\User;

class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getIndex()
  {
      return view('usuarios.usuarios');
  }

  public function anyData()
  {
      return Datatables::of(User::all())

      ->addColumn('action', function ($usuarios) {
      return [
              '<a href="usuarios/edit/'.$usuarios->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="setores/destroy/'.$usuarios->id.'" class="glyphicon glyphicon-trash" title="Deletar"
              onclick="return confirm(\'Excluir usuario?\')"></a>'
             ];
      })
      ->setRowData([
              'id' => 'test',
      ])
      ->setRowAttr([
              'color' => 'red',
      ])

      ->make(true);
  }
  public function getCreate()
  {
      return view('usuarios.usuarios-new-edit');
  }


  public function postStore(Request $request)
  {
      $input = $request->all();
      User::create($input);

      return redirect()->route('usuarios');

  }

  public function getDestroy($id)
  {
      User::find($id)->delete();

      return redirect()->route('usuarios');
  }

  public function getEdit($id)
  {
      $setor = User::find($id);
      return view('usuarios.usuarios-new-edit');
  }


  public function postUpdate(Request $request, $id)
  {
      $setor = User::find($id)->update($request->all());

      return redirect()->route('usuarios');
  }
}
