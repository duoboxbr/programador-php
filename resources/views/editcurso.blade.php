@extends("template")

@section("conteudo")

    <div class="col-md-12">
        <h3>Editar Curso</h3>
    </div>

    <div class="col-md-6 well">
        <form class="com-md-12" action="{{ url('curso/updatecurso') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id_curso" value="{{ $curso->id_curso }}">
            <div class="form-group col-md-12 {{ $errors->has('nm_curso') ? 'has-error' : '' }}">
                <label class="control-label">Curso:</label>
                <input type="text" name="nm_curso" value="{{ $curso->nm_curso }}" class="col-md-12 form-control">
                @if($errors->has('nm_curso'))
                    <span class="help-block">
                        {{ $errors->first('nm_curso') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-md-12 {{ $errors->has('ds_curso') ? 'has-error' : '' }}">
                <label class="control-label">Descrição:</label>
                <input type="text" name="ds_curso" value="{{ $curso->ds_curso }}" class="col-md-12 form-control">
                @if($errors->has('ds_curso'))
                    <span class="help-block">
                        {{ $errors->first('ds_curso') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-md-12">
                <button style="margin-top: 5px; float: right;" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>


@endsection