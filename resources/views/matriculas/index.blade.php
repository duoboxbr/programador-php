@extends('layout')

@section('content')
<div class="row">
    <div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="display-3">Matriculas</h1>    
        </div>
        <div class="col-sm-6">
            <br>
            <a href="{{ route('matriculas.create')}}" class="btn btn-primary pull-right">Adicionar</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
            <td>ID</td>
            <td>Curso</td>
            <td>Aluno</td>
            <td colspan = 2>Ação</td>
            </tr>
        </thead>
        <tbody>
            @foreach($matriculas as $matricula)
            <tr>
                <td>{{$matricula->id}}</td>
                <td>{{$matricula->titulo}}</td>
                <td>{{$matricula->nome}}</td>
                <td>
                    <a href="{{ route('matriculas.edit',$matricula->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('matriculas.destroy', $matricula->id)}}" method="post">
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
@endsection