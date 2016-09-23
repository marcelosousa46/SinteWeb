<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NotaRequest extends Request
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
           'natop'           => 'required|max:60',
           'cli_cod'         => 'required|max:60',
           'item_produto_id' => 'required',
        ];

    }
}
