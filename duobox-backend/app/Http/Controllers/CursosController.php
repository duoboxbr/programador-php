<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CursosController extends Controller
{
    public function getCursos(Request $request)
    {
        $query = Cursos::query();

        if (!empty($request->titulo) && $request->has('titulo')) {
            $query->where('titulo', 'LIKE', '%' . $request->titulo . '%');
        }

        if (!empty($request->descricao) && $request->has('descricao')) {
            $query->where('descricao', 'LIKE', '%' . $request->descricao . '%');
        }

        return $query->select(['id', 'titulo', 'descricao'])->paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 400);
        }

        $curso = Cursos::create($request->all());

        return response()->json($curso, 201);
    }

    public function update(Request $request, $cursoId)
    {
        $curso = Cursos::find($cursoId);

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 400);
        }

        $curso->titulo = $request->titulo;
        $curso->descricao = $request->descricao;

        $curso->update();

        return response()->json('Curso editado com sucesso');
    }

    public function delete($cursoId)
    {
        Cursos::find($cursoId)->delete();

        return response()->json('Curso deletado com sucesso');
    }
}
