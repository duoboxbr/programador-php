@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">Editar Curso</div>
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
    <form method="post" action="{{ route('cursos.update', $curso->id) }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
          <div class="form-group">    
              <label for="first_name">Título:</label>
              <input type="text" class="form-control" name="titulo" value={{ $curso->titulo }} />
          </div>

          <div class="form-group">
              <label for="last_name">Descrição:</label><br>
              <textarea id="story" name="descricao" rows="5" cols="170">{{ $curso->descricao }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary-outline">Salvar</button>
      </form>
  </div>
</div>
@endsection