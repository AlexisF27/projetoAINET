<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TshirtPost extends FormRequest
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
            'tamanho' => 'required|in:XS,S,M,L,XL',
            'data' => 'required|date_format:Y-m-d',
            'quantidade' => 'required|numeric|0.01,999999.99',
            'subtotal' => 'required|numeric|0.01,999999.99',
            'cor_codigo' => 'required|exists:cores,codigo',
            'estampa_id' => 'required|exists:estampas,id',
            'encomenda_id' => 'required|exists:encomendas,id'
            //
        ];
    }
}
