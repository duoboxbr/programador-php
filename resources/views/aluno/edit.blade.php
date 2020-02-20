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
         <h4 class="text-center">Editar Aluno</h4>
         <hr>
         <div class="col-8 m-auto">
            <form name="formEdit" id="formEdit" method="post" action="{{url("aluno/editar/$aluno->id")}}">
            @method('PUT')
            @csrf
            <div class="form-group row">
               <label  class="col-sm-2 col-form-label">Nome</label>
               <div class="col-sm-10">
                  <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome"  value="{{$aluno->nome ?? ''}}" required>
               </div>
            </div>
            <div class="form-group row">
               <label  class="col-sm-2 col-form-label">E-mail</label>
               <div class="col-sm-10">
                  <input class="form-control" type="email" name="email" id="email" placeholder="E-mail:" value="{{$aluno->email ?? ''}}" required>
               </div>
            </div>
            <div class="form-group row">
               <label  class="col-sm-2 col-form-label">Data de Nascimento</label>
               <div class="col-sm-10">
                  <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" value="{{ date('Y-m-d', strtotime($aluno->data_nascimento)) }}" required>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-lg"></i> Editar
                  </button>
                  <a href="/alunos" class="btn btn-secondary"><i class="fa fa-undo fa-lg"></i> Voltar</a>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection