<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Aluno;

class AlunoController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $alunos = Aluno::all();

        return view('alunos.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [
            'nome'  => 'required',
            'email' => 'required'
        ]);

        $aluno = new Aluno;
        $aluno->nome            = $request->get('nome');
        $aluno->email           = $request->get('email');
        $aluno->data_nascimento = date("Y-m-d", strtotime( $request->get('data_nascimento')));

        $aluno->save();

        return redirect('/alunos')->with('success', 'Aluno salvo com sucesso');
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
        $aluno = Aluno::find($id);

        return view('alunos.edit', compact('aluno'));
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
            'nome'  => 'required',
            'email' => 'required'
        ]);
        
        $aluno = Aluno::find($id);
        $aluno->nome            = $request->get('nome');
        $aluno->email           = $request->get('email');
        $aluno->data_nascimento = date("Y-m-d", strtotime( $request->get('data_nascimento')));

        $aluno->save();

        return redirect('/alunos')->with('success', 'Aluno editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $aluno = Aluno::find($id);
        $aluno->delete();
        return redirect('/alunos')->with('success', 'Aluno deletado com sucesso.');
    }
}
