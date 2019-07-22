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
    <form method="post" action="{{ route('alunos.store') }}">
        {{ csrf_field() }}
        <div class="form-group">    
            <label for="first_name">Nome:</label>
            <input type="text" class="form-control" name="nome"/>
        </div>

        <div class="form-group">    
            <label for="first_name">E-mail:</label>
            <input type="text" class="form-control" name="email"/>
        </div>

        <div class="form-group">    
            <label for="first_name">Data Nascimento:</label>
            <input type="text" class="form-control" name="data_nascimento" id="data_nascimento" placeholder="Ex.: dd/mm/aaaa" data-mask="00/00/0000" maxlength="10" autocomplete="off"/>
        </div>

        <button type="submit" class="btn btn-primary-outline">Salvar</button>
      </form>
  </div>
</div>
@endsection