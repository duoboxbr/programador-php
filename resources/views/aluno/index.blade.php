@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-12">
         <h4 class="text-center">Alunos</h4>
         <hr>
      </div>
      <div class="col-6">
         <div class="form-group">
            <label class="col-sm-12 control-label">Pesquisar por Nome</label>
            <form action="{{url('aluno/buscar_nome')}}" method="GET" action="/" class="form-inline" >
               <input name="nome" class="form-control" type="text" required>
               <button type="submit" class="btn btn-default"> Pesquisar
               </button>
            </form>
         </div>
      </div>
      <div class="col-6">
         <div class="form-group">
            <label class="col-sm-12 control-label">Pesquisar por E-mail</label>
            <form action="{{url('aluno/buscar_email')}}" method="GET" action="/" class="form-inline" >
               <input name="email" class="form-control" type="text" required>
               <button type="submit" class="btn btn-default"> Pesquisar
               </button>
            </form>
         </div>
      </div>
      <div class="col-12">
         <table class="table table-bordred table-striped text-center">
            <thead class="thead-dark">
               <tr>
                  <th scope="col">Alunos</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach($aluno as $alunos)
               <tr>
                  <td>{{$alunos->nome}}</td>
                  <td>{{$alunos->email}}</td>
                  <td>
                     <a title="Visualizar" href="{{url("aluno/$alunos->id")}}">
                     <button class="btn btn-dark"><i class="fa fa-eye" aria-hidden="true"></i></button>
                     </a>
                     <a title="Editar" href="{{url("aluno/editar/$alunos->id")}}">
                     <button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                     </a>
                     <a title="Deletar" href="{{url("aluno/excluir/$alunos->id")}}" id="{{ $alunos->id }}" data-method="DELETE" class="delete-btn">
                     <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                     </a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
</div>
@endsection