@extends('layout')

@section('content')
<div class="row">
    <div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="display-3">Cursos</h1>    
        </div>
        <div class="col-sm-6">
            <br>
            <a href="{{ route('cursos.create')}}" class="btn btn-primary pull-right">Adicionar</a>
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
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td>{{$curso->id}}</td>
                <td>{{$curso->titulo}}</td>
                <td>
                    <a href="{{ route('cursos.edit',$curso->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('cursos.destroy', $curso->id)}}" method="post">
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