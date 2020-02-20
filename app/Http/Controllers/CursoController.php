<?php

namespace App\Http\Controllers;

use App\Models\ModelCurso;
use Illuminate\Http\Request;
use App\Http\Requests\CursoRequest;

class CursoController extends Controller
{
    private $objCurso;

    public function __construct()
    {

        $this->objCurso = new ModelCurso();    

    }

    public function index()
    {
        $curso=$this->objCurso->all();
        return view('curso.index',compact('curso'));

    }

    public function create()
    {

        return view('curso.create');
    }

    public function store(CursoRequest $request)
    {
        $cad=$this->objCurso->create([
           'curso'=>$request->curso,
           'descricao'=>$request->filled('descricao') ? $request->get('descricao') : null,
        ]);
        if($cad){
            return redirect('curso');
        }
    }

    public function show($id)
    {   
         $curso=$this->objCurso->find($id);
         return view('curso.show',compact('curso'));
    }

    public function edit($id)
    {
        $curso=$this->objCurso->find($id);
        return view('curso.edit',compact('curso'));
    }

    public function update(CursoRequest $request, $id)
    {
        $this->objCurso->where(['id'=>$id])->update([
            'curso'=>$request->curso,
            'descricao'=>$request->descricao
        ]);
        return redirect('curso');
    }

    public function destroy($id)
    {
        $del=$this->objCurso->destroy($id);   
        return "true";

    }
}
