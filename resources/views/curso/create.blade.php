@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-8 m-auto">
         @if(isset($errors) && count($errors)>0)
         <div class="text-center mt-4 mb-4 p-2 alert-danger">
            @foreach($errors->all() as $erro)
            {{$erro}}
            @endforeach
         </div>
         @endif       
      </div>
      <div class="col-12">
         <h4 class="text-center">Cadastrar Curso</h4>
         <hr>
         <div class="col-8 m-auto">
            <form name="formCad" id="formCad" method="post" action="{{url('curso/salvar')}}">
               @csrf
               <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Curso</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="curso" id="curso" placeholder="Curso" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Descrição</label>
                  <div class="col-sm-10">
                     <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição" rows="4"></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-10">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-lg"></i> Salvar
                     </button>
                     <a href="/cursos" class="btn btn-secondary"><i class="fa fa-undo fa-lg"></i> Cancelar</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection