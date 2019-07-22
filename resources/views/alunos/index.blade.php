@extends('layout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<div class="row">
    <div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            <h1>Alunos</h1>    
        </div>
        <div class="col-sm-6">
            <br>
            <a href="{{ route('alunos.create')}}" class="btn btn-primary pull-right">Adicionar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
        </div>
        <div class="col-sm-3">
            <label class="pull-right">Pesquisar:<input type="search" class="pull-right" placeholder="" id="pesquisar"></label>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
            <td>ID</td>
            <td>Curso</td>
            <td colspan = 2>Ação</td>
            </tr>
        </thead>
        <tbody id="tabela" >
            @foreach($alunos as $aluno)
            <tr>
                <td>{{$aluno->id}}</td>
                <td>{{$aluno->nome}}</td>
                <td>{{$aluno->email}}</td>
                <td>
                    <a href="{{ route('alunos.edit',$aluno->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('alunos.destroy', $aluno->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
<script>

$(document).ready(function() {
	 $("#pesquisar").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#tabela tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		    });
		  });
  
});

</script>
@endsection