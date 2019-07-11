<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Curso;
use App\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatriculasController extends Controller {

    public function __construct() {
        $this->matricula = new Matricula();
    }

    public function matricula() {
        $list_matriculas = Matricula::all();
        return view('matricula',[
            'matriculas' => $list_matriculas
        ]);
    }

    public function addMatricula($id_aluno) {
        $aluno = Aluno::find($id_aluno);
        $list_cursos = Curso::all()->sortBy('nm_curso');
        return view('addmatricula',[
            'aluno' => $aluno,
            'cursos' => $list_cursos
        ]);
    }

    public function saveMatricula(Request $request) {
        $validacao = $this->validaMatricula($request->all());
        if ($validacao->fails()){
            return redirect()->back()
                ->withErrors($validacao->errors())
                ->withInput($request->all());
        }
        Matricula::create($request->all());
        return redirect('/aluno')->with('message','Matricula criada com sucesso!');
    }

    public function editMatricula($id_aluno, $id_curso) {
        return view('editmatricula',[
            'id_aluno' => $id_aluno,
            'id_curso' => $id_curso
        ]);
    }

    public function delMatricula($id_aluno, $id_matricula) {
        $matricula = Matricula::find($id_matricula);
        $aluno = Aluno::find($matricula->id_aluno);
        $curso = Curso::find($matricula->id_curso);
        return view('delMatricula', [
            'matricula' => $id_matricula,
            'aluno' => $aluno,
            'curso' => $curso
        ]);
    }

    public function destroyMatricula($id_matricula) {
        $matricula = Matricula::findOrFail($id_matricula);
        $matricula->delete();
        return redirect(url('aluno'))->with('success','Matricula Excluída!');
    }

    private function validaMatricula($data) {
        $regras = [
            'id_curso' => 'required|integer'
        ];

        $mensagens = [
            'id_curso.required' => 'Campo curso é obrigatório',
            'id_curso.integer' => 'Você deve escolher um Curso'
        ];

        return Validator::make($data, $regras, $mensagens);
    }

}
