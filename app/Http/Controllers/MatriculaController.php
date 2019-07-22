<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Matricula;
use App\Curso;
use App\Aluno;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $matriculas = Matricula::join('cursos', 'matriculas.curso_id', '=', 'cursos.id')
                               ->join('alunos', 'matriculas.aluno_id', '=', 'alunos.id')
                               ->select('matriculas.id', 'cursos.titulo', 'alunos.nome')
                               ->get();
        return view('matriculas.index', compact('matriculas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $cursos = Curso::all(['id', 'titulo']);
        $alunos = Aluno::all(['id', 'nome']);

        return view('matriculas.create', compact('id', 'cursos'), compact('id', 'alunos'));
        return view('matriculas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [
            'aluno_id'  => 'required',
            'curso_id' => 'required'
        ]);

        $matricula = new Matricula;
        $matricula->aluno_id = $request->get('aluno_id');
        $matricula->curso_id = $request->get('curso_id');

        $matricula->save();

        return redirect('/matriculas')->with('success', 'Matricula salva com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $cursos    = Curso::all(['id', 'titulo']);
        $alunos    = Aluno::all(['id', 'nome']);
        $matricula = Matricula::find($id);

        return view('matriculas.edit', compact('matricula'), compact(['id', 'cursos'],['id', 'alunos']));
        return view('matriculas.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, [
            'aluno_id'  => 'required',
            'curso_id' => 'required'
        ]);

        $matricula = Matricula::find($id);
        $matricula->aluno_id = $request->get('aluno_id');
        $matricula->curso_id = $request->get('curso_id');

        $matricula->save();

        return redirect('/matriculas')->with('success', 'Matricula salva com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $matricula = Matricula::find($id);
        $matricula->delete();
        return redirect('/matriculas')->with('success', 'Matricula deletada com sucesso.');
    }
}
