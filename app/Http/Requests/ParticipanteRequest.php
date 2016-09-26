<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ParticipanteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'codigo'          => 'required|max:60',
           'nome'            => 'required|max:60',
           'endereco'        => 'required|max:60',
           'cpais'           => 'required|max:4',
           'pais'            => 'required|max:20',
           'ibge'            => 'required|max:7',
           'fone'            => 'required|max:12',
           'cep'             => 'required|max:8',
           'uf'              => 'required|max:2',
           'municipio'       => 'required|max:20',
           'cnpj'            => 'required|max:14',
           'cpf'             => 'max:11',
        ];
    }
}
