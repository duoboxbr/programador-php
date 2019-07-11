@extends("template")

@section("conteudo")

    <div class="col-md-6 well">
        <div class="col-md-12">
            <h3>Deseja excluir essa Matricula? </h3>
            Aluno: #{{$aluno->id_aluno}} - {{$aluno->nm_aluno}} <br>
            Curso: #{{$curso->id_curso}} - {{$curso->nm_curso}}
            <div style="float: right">
                <a class="btn btn-default" href="{{ url("aluno") }}">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                    &nbsp;Cancelar
                </a>
                <a class="btn btn-danger" href="{{ url("matricula/destroyMatricula/$matricula") }}">
                    <i class="glyphicon glyphicon-remove"></i>
                    &nbsp;Excluir
                </a>
            </div>
        </div>
    </div>
@endsection