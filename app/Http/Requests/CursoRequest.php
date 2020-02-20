<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'curso'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'curso.required' => 'Campo do curso é obrigatório',
        ];
    }    
}
