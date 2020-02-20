<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_aluno'=>'required',
            'id_curso'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'id_aluno.required' => 'Selecione um aluno é obrigatório',
            'id_curso.required' => 'Selecione um curso é obrigatório',
        ];
    } 
}
