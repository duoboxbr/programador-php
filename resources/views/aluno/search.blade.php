@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      @if(!$aluno->isEmpty())
      <div class="col-12">
         <h4 class="text-center">Aluno encontrado</h4>
         <hr>
      </div>
      <div class="col-12">
         <table class="table table-bordred table-striped text-center">
            <thead class="thead-dark">
               <tr>
                  <th scope="col">Aluno</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($aluno as $object) 
               <tr>
                  <td>{{$object->nome}}</td>
                  <td>{{$object->email}}</td>
                  <td>
                     <a title="Visualizar" href="{{url("aluno/$object->id")}}">
                     <button class="btn btn-dark"><i class="fa fa-eye" aria-hidden="true"></i></button>
                     </a>
                     <a title="Editar" href="{{url("aluno/editar/$object->id")}}">
                     <button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                     </a>
                     <a title="Deletar" href="{{url("aluno/excluir/$object->id")}}" id="{{ $object->id }}" data-method="DELETE" class="delete-btn">
                     <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                     </a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      @else
      <div class="col-12">
         @if(request()->get('nome'))
         <h4 class="text-center">Nenhum aluno encontrado!</h4>
         @endif
         @if(request()->get('email'))
         <h4 class="text-center">Nenhum e-mail encontrado!</h4>
         @endif
         <p  class="text-center" >Cadastre um novo aluno!</p>
         <hr>
         <div class="text-center mt-3 mb-4">
            <a href="{{url('aluno/cadastrar')}}">
            <button class="btn btn-primary">Cadastrar</button>
            </a>
            <a href="/alunos" class="btn btn-secondary"><i class="fa fa-undo fa-lg"></i> Voltar</a>
         </div>
      </div>
      @endif
   </div>
</div>
</div>
@endsection