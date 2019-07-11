<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlunosController extends Controller {

    private $aluno;

    public function __construct() {
        $this->aluno = new Aluno();
    }

    public function aluno() {
        $list_alunos = Aluno::all()->sortBy('nm_aluno');
        return view('aluno',[
            'alunos' => $list_alunos,
            'criterio' => 'Geral'
        ]);
    }

    public function alunoLetra($letra) {
        $list_alunos = Aluno::indexLetraAluno($letra)->sortBy('nm_aluno');
        return view('aluno',[
            'alunos' => $list_alunos,
            'criterio' => $letra
        ]);
    }

    public function buscaNomeAluno(Request $request) {
        $alunos = Aluno::buscaNomeAluno($request->criterio);
        return view('aluno', [
            'alunos' => $alunos,
            'criterio' => $request->criterio
        ]);
    }

    public function buscaEmailAluno(Request $request) {
        $alunos = Aluno::buscaEmailAluno($request->criterio);
        return view('aluno', [
            'alunos' => $alunos,
            'criterio' => $request->criterio
        ]);
    }

    public function addAluno() {
        return view('addaluno');
    }

    public function saveAluno(Request $request) {
        $validacao = $this->validaAluno($request->all());
        if ($validacao->fails()){
            return redirect()->back()
                ->withErrors($validacao->errors())
                ->withInput($request->all());
        }
        Aluno::create($request->all());
        return redirect('/aluno')->with('message','Aluno criado com sucesso!');
    }

    public function editAluno($id_aluno) {
        return view('editaluno',['aluno'=>$this->getAluno($id_aluno)]);
    }

    public function delAluno($id_aluno) {
        return view('delaluno', ['aluno' => $this->getAluno($id_aluno)]);
    }

    public function destroyAluno($id_aluno) {
        $this->getAluno($id_aluno)->delete();
        return redirect(url('aluno'))->with('success','Aluno Excluído!');
    }

    protected function getAluno($id_aluno) {
        return $this->aluno->find($id_aluno);
    }

    public function updateAluno(Request $request) {
        $validacao = $this->validaAluno($request->all());
        if ($validacao->fails()){
            return redirect()->back()
                ->withErrors($validacao->errors())
                ->withInput($request->all());
        }
        $aluno = $this->getAluno($request->id_aluno);
        $aluno->update($request->all());
        return redirect('/aluno');
    }

    private function validaAluno($data) {
        $regras = [
            'nm_aluno' => 'required|min:3',
            'ds_email' => 'required'
        ];
        if (array_key_exists('dt_nascimento', $data)) {
            if ($data['dt_nascimento']) {
                $regras['dt_nascimento'] = 'date_format:Y-m-d';
            }
        }

        $mensagens = [
            'nm_aluno.required' => 'Campo nome é obrigatório',
            'nm_aluno.min' => 'Campo nome deve ter ao menos 3 letras',
            'ds_email.required' => 'Campo e-mail é obrigatório',
            'dt_nascimento.date_format' => 'Data Nascimento precisa ser do formato Y-m-d'
        ];

        return Validator::make($data, $regras, $mensagens);
    }
}
