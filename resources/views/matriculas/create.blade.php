@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">Adicionar Aluno</div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <form method="post" action="{{ route('matriculas.store') }}">
        {{ csrf_field() }}
        <div class="form-group">    
            <label for="first_name">Curso:</label>
            <select name="curso_id" id="curso_id" class="form-control">
            <option value=""></option>
              @foreach($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->titulo }}</option>
              @endforeach
            </select>
        </div>

        <div class="form-group">    
            <label for="first_name">Aluno:</label>
            <select name="aluno_id" id="aluno_id" class="form-control">
            <option value=""></option>
              @foreach($alunos as $aluno)
                <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
              @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary-outline">Salvar</button>
      </form>
  </div>
</div>
@endsection