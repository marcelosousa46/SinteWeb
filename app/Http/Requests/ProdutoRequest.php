<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProdutoRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
           'codigo'          => 'required|max:60',
           'descricao'       => 'required|max:60',
           'codigo_barra'    => 'max:60',
           'codigo_anterior' => 'max:60',
           'unidade_id'      => 'required',
           'tipoitem_id'     => 'required',
           'ncm_id'          => 'required',
           'genero_id'       => 'required',
           'preco_venda'     => 'required',
           'lst'             => 'max:5',
           'ipi'             => 'max:3'
        ];
    }
}
