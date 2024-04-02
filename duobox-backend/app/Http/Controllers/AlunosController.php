<?php

namespace App\Http\Controllers;

use App\Models\Alunos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AlunosController extends Controller
{
    public function getAlunos(Request $request)
    {
        $query = Alunos::query();

        if (!empty($request->nome) && $request->has('nome')) {
            $query->where('nome', 'LIKE', '%' . $request->nome . '%');
        }

        if (!empty($request->email) && $request->has('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        return $query->select(['id', 'nome', 'email', 'dat_nascimento'])->paginate(10);
    }

    public function getAlunosMatriculados(Request $request, $cursoId)
    {
        return Alunos::select(['id', 'nome', 'email', 'dat_nascimento'])->where('curso_id', $cursoId)->paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email',
            'dat_nascimento' => 'required|date',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.unique' => 'O campo email já está em uso',
            'email.email' => 'O campo email não é um email válido',
            'dat_nascimento.required' => 'O campo data de nascimento é obrigatório',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 400);
        }

        $data = new \DateTime($request->dat_nascimento);
        $dataNascimento = $data->format('d/m/Y');

        $curso = Alunos::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'dat_nascimento' => $dataNascimento,
        ]);

        return response()->json($curso, 201);
    }

    public function update(Request $request, $cursoId)
    {
        $aluno = Alunos::find($cursoId);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'dat_nascimento' => 'required',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 400);
        }

        $aluno->nome = $request->nome;
        $aluno->email = $request->email;
        $aluno->dat_nascimento = $request->dat_nascimento;

        $aluno->update();

        return response()->json('Aluno editado com sucesso');
    }

    public function matricular(Request $request, $alunoId)
    {
        if (empty($request->curso_id)) {
            return response()->json(['error' => 'Aluno não encontrado'], 400);
        }

        $aluno = Alunos::find($alunoId);

        $aluno->curso_id = $request->curso_id;

        $aluno->update();

        return response()->json('Aluno matrículado com sucesso');
    }

    public function delete($alunoId)
    {
        Alunos::find($alunoId)->delete();

        return response()->json('Aluno deletado com sucesso');
    }

    public function removerMatricula($alunoId)
    {
        $aluno = Alunos::find($alunoId);

        $aluno->curso_id = null;

        $aluno->update();

        return response()->json('Matrícula removida com sucesso');
    }
}
