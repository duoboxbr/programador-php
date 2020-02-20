@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-8 m-auto">
         @if(isset($errors) && count($errors)>0)
         <div class="text-center mt-4 mb-4 p-2 alert-danger">
            @foreach($errors->all() as $erro)
            {{$erro}}<br>
            @endforeach
         </div>
         @endif       
      </div>
      <div class="col-12">
         <h4 class="text-center">Realizar Matrícula</h4>
         <hr>
         <div class="col-8 m-auto">
            <form name="formCad" id="formCad" method="post" action="{{url('matricula/salvar')}}">
               @csrf
               <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Aluno</label>
                  <div class="col-sm-10">
                     <select class="form-control" name="id_aluno" id="id_aluno" required>
                        <option value="" >Selecione aluno</option>
                        @foreach($aluno as $alunos)
                        <option value="{{$alunos->id}}">{{$alunos->nome}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Curso</label>
                  <div class="col-sm-10">
                     <select class="form-control" name="id_curso" id="id_curso" required>
                        <option value="">Selecione curso</option>
                        @foreach($curso as $cursos)
                        <option value="{{$cursos->id}}">{{$cursos->curso}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-10">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-lg"></i> Salvar
                     </button>
                     <a href="/matriculas" class="btn btn-secondary"><i class="fa fa-undo fa-lg"></i> Cancelar</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection