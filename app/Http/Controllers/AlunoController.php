<?php

namespace App\Http\Controllers;
use App\Models\ModelAluno;
use Illuminate\Http\Request;
use App\Http\Requests\AlunoRequest;
use Illuminate\Support\Facades\DB;
use DateTime;

class AlunoController extends Controller
{
    private $objAluno;


    public function __construct()
    {

        $this->objAluno = new ModelAluno();    

    }

    public function index()
    {
        $aluno=$this->objAluno->all();
        return view('aluno.index',compact('aluno'));

    }

    public function create()
    {
        return view('aluno.create');
    }

    public function store(AlunoRequest $request)
    {  
        $dt_nascimento = DateTime::createFromFormat('Y-m-d', $request->data_nascimento);
        $cad=$this->objAluno->create([
           'nome'=>$request->nome,
           'email'=>$request->email,
           'data_nascimento'=>$dt_nascimento

        ]);
        if($cad){
            return redirect('aluno');
        }
    }

    public function show($id)
    {
        $aluno=$this->objAluno->find($id);
        return view('aluno.show',compact('aluno'));
    }

    public function edit($id)
    {
        $aluno=$this->objAluno->find($id);
        return view('aluno.edit',compact('aluno'));
    }

    public function update(AlunoRequest $request, $id)
    {
        $dt_nascimento = DateTime::createFromFormat('Y-m-d', $request->data_nascimento);
        $this->objAluno->where(['id'=>$id])->update([
            'nome'=>$request->nome,
            'email'=>$request->email,
            'data_nascimento'=>$dt_nascimento
        ]);
        return redirect('aluno');
    }

    public function buscarNome(Request $request)
    {

        $nome = $request->query('nome');
        $aluno = DB::table('tb_alunos')
            ->where('nome', 'like',  "%" .$nome)
            ->get();
         return view('aluno.search')->with('aluno', $aluno);
    }

    public function buscarEmail(Request $request)
    {

        $email = $request->query('email');
        $aluno = DB::table('tb_alunos')
            ->where('email', 'like',  "%" .$email)
            ->get();
         return view('aluno.search')->with('aluno', $aluno);
    }
    
    public function destroy($id)
    {
        $del=$this->objAluno->destroy($id);   
        return "true";
    }
}
