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
        <h1>Listagem de Cursos:</h1>
    </div>
    <div class="col-md-12 well">
        <div class="col-sm-12" style="padding-bottom: 10px">
            <a href="{{ url('curso/') }}" class="btn btn-primary ">
                GERAL
            </a>
            @foreach(range('A', 'Z') as $letra)
                <div class="btn-group">
                    <a href="{{ url('curso/' . $letra) }}" class="btn btn-primary {{ $letra === $criterio ? 'disabled' : '' }}">
                        {{ $letra }}
                    </a>
                </div>
            @endforeach
        </div>

        <h1 class="col-sm-8">Critério: {{ $criterio }}</h1>

        <div class="col-sm-12" style="padding-bottom: 10px">
            <form action="{{ url('/curso/busca') }}" method="post">
                <div style="margin-top: 10px" class="col-sm-4 input-group">
                    {{ csrf_field() }}
                    <input type="text" class="form-control" name="criterio" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Buscar</button>
                    </span>
                </div>
            </form>
        </div>

        @foreach($cursos as $curso)
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        #{{ $curso->id_curso }} -
                        {{ $curso->nm_curso }}
                        <a href="{{ url("/curso/$curso->id_curso/excluir") }}" class="btn btn-xs btn-danger btn-action">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                        <a href="{{ url("/curso/$curso->id_curso/editar") }}" class="btn btn-xs btn-primary btn-action">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                    </div>
                    <div class="panel-body">
                        <p><strong>Descrição: </strong> {{ $curso->ds_curso }} </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection