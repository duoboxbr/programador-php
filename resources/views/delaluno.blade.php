@extends("template")

@section("conteudo")

    <div class="col-md-6 well">
        <div class="col-md-12">
            <h3>Deseja excluir esse Aluno?</h3>
            <div style="float: right">
                <a class="btn btn-default" href="{{ url("aluno") }}">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                    &nbsp;Cancelar
                </a>
                <a class="btn btn-danger" href="{{ url("aluno/$aluno->id_aluno/destroyAluno") }}">
                    <i class="glyphicon glyphicon-remove"></i>
                    &nbsp;Excluir
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                #{{ $aluno->id_aluno }} -
                {{ $aluno->nm_aluno }}
            </div>
            <div class="panel-body">
            </div>
        </div>
    </div>
@endsection