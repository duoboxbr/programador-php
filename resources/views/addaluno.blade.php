@extends("template")

@section("conteudo")

    <div class="col-md-12">
        <h3>Novo Aluno</h3>
    </div>

    <div class="col-md-6 well">
        <form class="com-md-12" action="{{ url('aluno/savealuno') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group col-md-12 {{ $errors->has('nm_aluno') ? 'has-error' : '' }}">
                <label class="control-label">Nome:</label>
                <input type="text" name="nm_aluno" value="{{ old('nm_aluno') }}" class="col-md-12 form-control">
                @if($errors->has('nm_aluno'))
                    <span class="help-block">
                        {{ $errors->first('nm_aluno') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-md-12 {{ $errors->has('ds_email') ? 'has-error' : '' }}">
                <label class="control-label">e-mail:</label>
                <input type="text" name="ds_email" value="{{ old('ds_email') }}" class="col-md-12 form-control">
                @if($errors->has('ds_email'))
                    <span class="help-block">
                        {{ $errors->first('ds_email') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-md-12 {{ $errors->has('dt_nascimento') ? 'has-error' : '' }}">
                <label class="control-label">Dt Nascimento:</label>
                <input type="text" name="dt_nascimento" value="{{ old('dt_nascimento') }}" class="col-md-12 form-control">
                @if($errors->has('dt_nascimento'))
                    <span class="help-block">
                        {{ $errors->first('dt_nascimento') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-md-12">
                <button style="margin-top: 5px; float: right;" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>


@endsection