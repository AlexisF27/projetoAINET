<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EncomendaPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            return [
                'estado' => 'required|in:pendiente,paga,fechada,anulada',
                'data' => 'required|date_format:Y-m-d',
                'preco_total' => 'required|numeric|0.01,999999.99',
                'notas' => 'nullable',
                'nif' => 'required|max:255',
                'endereco' => 'nullable',
                'tipo_pagamento' => 'required|in:VISA,MC,PAYPAL',
                'ref_pagamento' => 'required|max:255',
                'recibo_url' => 'nullable|max:255',
                'cliente_id' => 'required|cliente,id'
            ];
    }

    public function messages()
    {
        return[
            'preco_total.required' => 'É obrigatorio colocar numeros entre 0.01,999999.99',
            'nif.required' => 'É obrigatorio colocar o nif',
            'data.required' => 'É obrigatorio colocar a data',
        ];

    }
}
