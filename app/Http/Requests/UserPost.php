<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPost extends FormRequest
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
            'tipo' => 'required|in:C,F,A',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|password',
            'bloqueado' => 'required|boolean',
            'foto_url' => 'nullable'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'É obrigatorio colocar o nome',
            'email.required' => 'É obrigatorio colocar o email',
            'password.required' => 'É obrigatorio colocar o password',
        ];
    }
}
