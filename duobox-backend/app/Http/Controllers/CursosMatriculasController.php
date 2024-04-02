<?php

namespace App\Http\Controllers;

use App\Models\CursosMatriculas;
use Illuminate\Http\Request;

class CursosMatriculasController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'aluno_id' => 'required|exists:alunos,id',
        ]);

        $cursoMatricula = CursosMatriculas::create($request->all());

        return response()->json($cursoMatricula, 201);
    }
}
