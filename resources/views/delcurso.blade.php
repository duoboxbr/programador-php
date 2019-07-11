@extends("template")

@section("conteudo")

    <div class="col-md-6 well">
        <div class="col-md-12">
            <h3>Deseja excluir esse Curso?</h3>
            <div style="float: right">
                <a class="btn btn-default" href="{{ url("curso") }}">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                    &nbsp;Cancelar
                </a>
                <a class="btn btn-danger" href="{{ url("curso/$curso->id_curso/destroyCurso") }}">
                    <i class="glyphicon glyphicon-remove"></i>
                    &nbsp;Excluir
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                #{{ $curso->id_curso }} -
                {{ $curso->nm_curso }}
            </div>
            <div class="panel-body">
                <p><strong>Descrição: </strong> {{ $curso->ds_curso }} </p>
            </div>
        </div>
    </div>
@endsection
