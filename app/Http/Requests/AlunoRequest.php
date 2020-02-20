<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
{ 
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome'=>'required',
            'email'=>'required',
            'data_nascimento'=> 'required|date|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Campo do nome é obrigatório',
            'email.required'  => 'Campo do e-mail é obrigatório',
            'data_nascimento.required'=> 'Campo data de nascimento é obrigatório',
        ];
    }  

}
