@extends("template")

@section("conteudo")
    <style>
        .btn-action {
            padding: 5px;
            margin-left: 5px;
            float: right;
        }
    </style>

    <div class="col-sm-12 ">
        <h1>Listagem de Alunos:</h1>
    </div>
    <div class="col-sm-12 well">
        <div class="col-sm-12" style="padding-bottom: 10px">
            <a href="{{ url('aluno/') }}" class="btn btn-primary ">
                GERAL
            </a>
            @foreach(range('A', 'Z') as $letra)
                <div class="btn-group">
                    <a href="{{ url('aluno/' . $letra) }}" class="btn btn-primary {{ $letra === $criterio ? 'disabled' : '' }}">
                        {{ $letra }}
                    </a>
                </div>
            @endforeach
        </div>

        <h1 class="col-sm-8">Critério: {{ $criterio }}</h1>

        <div class="col-sm-12" style="padding-bottom: 10px">
            <form action="{{ url('/aluno/buscaNome') }}" method="post">
                <div style="margin-top: 10px" class="col-sm-4 input-group">
                    {{ csrf_field() }}
                    <input type="text" class="form-control" name="criterio" placeholder="Buscar nome...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Buscar</button>
                    </span>
                </div>
            </form>
            <form action="{{ url('/aluno/buscaEmail') }}" method="post">
                <div style="margin-top: 10px" class="col-sm-4 input-group">
                    {{ csrf_field() }}
                    <input type="text" class="form-control" name="criterio" placeholder="Buscar e-mail...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Buscar</button>
                    </span>
                </div>
            </form>
        </div>

        @foreach($alunos as $aluno)
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        #{{ $aluno->id_aluno }} -
                        {{ $aluno->nm_aluno }} <br>
                        {{ $aluno->ds_email }}
                        <a href="{{ url("/aluno/$aluno->id_aluno/excluir") }}" class="btn btn-xs btn-danger btn-action" title="Excluir Aluno">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                        <a href="{{ url("/aluno/$aluno->id_aluno/editar") }}" class="btn btn-xs btn-primary btn-action" title="Editar Aluno">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                    </div>
                    <div class="panel-body">
                        <a href="{{ url("/matricula/novo/$aluno->id_aluno") }}">
                            <button type="button" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nova Matrícula
                            </button>
                        </a>
                        <br><br>
                        @foreach($aluno->matriculas as $matricula)

                            <p>
                                <strong>Curso Matriculado: </strong> #{{ $matricula->id_curso }} - {{ $aluno->curso($matricula->id_curso)->nm_curso }}
                                <a href="{{ url("/matricula/$aluno->id_aluno/excluir/$matricula->id_matricula") }}" title="Excluir Matricula">
                                    <button type="button" class="btn btn-default btn-xs">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </a>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
