<?php

namespace dioVentas\Http\Requests;

use dioVentas\Http\Requests\Request;

class PedidoFormRequest extends Request
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
            'idcliente'=>'required',
            'idarticulo'=>'required',
            'cantidad'=>'required',
            'observacion'=>'required'
           

        ];
    }
}
