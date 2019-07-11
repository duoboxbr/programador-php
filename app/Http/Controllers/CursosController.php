<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CursosController extends Controller {

    private $curso;

    public function __construct() {
        $this->curso = new Curso();
    }

    public function curso() {
        $list_cursos = Curso::all()->sortBy('nm_curso');
        return view('curso',[
            'cursos' => $list_cursos,
            'criterio' => 'Geral'
        ]);
    }

    public function cursoLetra($letra) {
        $list_cursos = Curso::indexLetraCurso($letra)->sortBy('nm_curso');
        return view('curso',[
            'cursos' => $list_cursos,
            'criterio' => $letra
        ]);
    }

    public function buscaCurso(Request $request) {
        $cursos = Curso::buscaNomeCurso($request->criterio);
        return view('curso', [
            'cursos' => $cursos,
            'criterio' => $request->criterio
        ]);
    }

    public function addCurso(){
        return view('addcurso');
    }

    public function saveCurso (Request $request){
        $validacao = $this->validaCurso($request->all());
        if ($validacao->fails()){
            return redirect()->back()
                ->withErrors($validacao->errors())
                ->withInput($request->all());
        }
        Curso::create($request->all());
        return redirect('/curso')->with('message','Curso criado com sucesso!');
    }

    public function editCurso($id_curso){
        return view('editcurso',['curso'=>$this->getCurso($id_curso)]);
    }

    public function delCurso($id_curso) {
        return view('delcurso', ['curso' => $this->getCurso($id_curso)]);
    }

    public function destroyCurso($id_curso) {
        $this->getCurso($id_curso)->delete();
        return redirect(url('curso'))->with('success','Curso Excluído!');
    }

    protected function getCurso($id_curso) {
        return $this->curso->find($id_curso);
    }

    public function updateCurso(Request $request) {
        $validacao = $this->validaCurso($request->all());
        if ($validacao->fails()){
            return redirect()->back()
                ->withErrors($validacao->errors())
                ->withInput($request->all());
        }
        $curso = $this->getCurso($request->id_curso);
        $curso->update($request->all());
        return redirect('/curso');
    }

    private function validaCurso($data) {
        $regras = [
            'nm_curso' => 'required|min:3'
        ];

        $mensagens = [
            'nm_curso.required' => 'Campo curso é obrigatório',
            'nm_curso.min' => 'Campo curso deve ter ao menos 3 letras'
        ];

        return Validator::make($data, $regras, $mensagens);
    }

}
