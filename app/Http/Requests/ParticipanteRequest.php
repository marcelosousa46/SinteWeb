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
           'pais_id'         => 'required|max:5',
           'cnpj'            => 'required|max:14',
        ];
    }
}
