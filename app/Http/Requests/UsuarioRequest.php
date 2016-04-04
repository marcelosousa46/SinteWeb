<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioRequest extends Request
{
    public function authorize(Request $request)
    {
        dd($request);
        $query = ($request->query());
        $request->session()->put('rotina_id', $query['id']);
        $crud = auth()->user()->Crud(session('rotina_id'));
        return false;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
