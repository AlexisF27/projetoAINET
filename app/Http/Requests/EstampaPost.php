<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstampaPost extends FormRequest
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
            'nome' => 'required|max:255',
            'descricao' => 'required|max:255',
            'imagem_url' => 'required'
            //
        ];
    }

    public function messages()
    {
        return[
            'nome.required' => 'É obrigatorio colocar nome',
            'imagem_url.required' => 'É obrigatorio colocar uma imagem'
        ];

    }
}
