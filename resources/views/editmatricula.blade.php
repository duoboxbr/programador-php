@extends("template")

@section("conteudo")

    <div class="col-md-12">
        <h3>Edita Matricula</h3>
    </div>

    <div class="col-md-6 well">
        <form class="com-md-12" action="{{ url('matricula/savematricula') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group col-md-12">
                <label class="control-label">Aluno:</label>
                <h4>#{{ $aluno->id_aluno }} - {{ $aluno->nm_aluno }}</h4>
                <input type="hidden" name="id_aluno" value="{{ $aluno->id_aluno }}">
            </div>
            <div class="form-group col-md-12">
                <label class="control-label">Curso:</label>

                <select class="form-control" name="id_curso">
                    <option>..:: SELECIONE CURSO ::..</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id_curso }}">#{{ $curso->id_curso }} - {{ $curso->nm_curso }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group col-md-12">
                <button style="margin-top: 5px; float: right;" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>


@endsection