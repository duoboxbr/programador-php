<?php

namespace App\Http\Controllers;

use App\Models\ModelMatricula;
use App\Models\ModelAluno;
use App\Models\ModelCurso;
use Illuminate\Http\Request;
use App\Http\Requests\MatriculaRequest;

class MatriculaController extends Controller
{
    private $objMatricula;
    private $objAluno;
    private $objCurso;


    public function __construct()
    {
        $this->objMatricula = new ModelMatricula();    
        $this->objAluno = new ModelAluno();
        $this->objCurso = new ModelCurso();
    }

    public function index()
    {
        $matricula=$this->objMatricula->all();
        return view('matricula.index',compact('matricula'));
    }

    public function create()
    {
        $aluno=$this->objAluno->all();
        $curso=$this->objCurso->all();
        return view('matricula.create',compact('aluno', 'curso'));
    }

    public function store(MatriculaRequest $request)
    {
        $cad=$this->objMatricula->create([
           'id_aluno'=>$request->id_aluno,
           'id_curso'=>$request->id_curso

        ]);
        if($cad){
            return redirect('matricula');
        }
    }

    public function show($id)
    {
        $matricula=$this->objMatricula->find($id);
        return view('matricula.show',compact('matricula'));
    }

    public function edit($id)
    {
        $matricula=$this->objMatricula->find($id);
        $aluno=$this->objAluno->all();
        $curso=$this->objCurso->all();
        return view('matricula.edit',compact('matricula','aluno','curso'));
    }

    public function update(MatriculaRequest $request, $id)
    {
        $this->objMatricula->where(['id'=>$id])->update([
            'id_aluno'=>$request->id_aluno,
            'id_curso'=>$request->id_curso
        ]);
        return redirect('matricula');
    }

    public function destroy($id)
    {
        $del=$this->objMatricula->destroy($id);   
        return "true";
    }
}
