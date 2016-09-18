<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Series;
use Yajra\Datatables\Datatables;

class SerieController extends Controller
{
  public function anyData()
  {
      $user_id  = session('user_id');
      $series = Series::all();

      return Datatables::of($series)

      ->addColumn('action', function ($series) {
      return [
              '<a href="serie/edit/'.$series->id.'" class="glyphicon glyphicon-pencil" title="Editar"></a>',
              '<a href="serie/destroy/'.$series->id.'" class="glyphicon glyphicon-trash" title="Deletar"
                                                            onclick="return confirm(\'Excluir serie?\')"></a>',
             ];
      })
      ->make(true);
  }

  public function anyNota(Request $request, $id)
  {
      $numeronota = Series::find($id)->ultimo + 1;
      Series::find($id)->update(['ultimo' => $numeronota]);
      return response()->json(['numnota' => $numeronota]);
  }
}
