@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-12">
         <h4 class="text-center">Matrículas</h4>
         <hr>
         <div class="table-responsive">
            <table class="table table-bordred table-striped text-center">
               <thead class="thead-dark">
                  <tr>
                     <th scope="col">Alunos</th>
                     <th scope="col">Cursos</th>
                     <th scope="col">Ações</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($matricula as $matriculas)
                  @php
                  $aluno=$matriculas->find($matriculas->id)->relAlunos;
                  $curso=$matriculas->find($matriculas->id)->relCursos;
                  @endphp
                  <tr>
                     <td>{{$aluno->nome}}</td>
                     <td>{{$curso->curso}}</td>
                     <td>
                        <a title="Visualizar" href="{{url("matricula/$matriculas->id")}}">
                        <button class="btn btn-dark"><i class="fa fa-eye" aria-hidden="true"></i></button>
                        </a>
                        <a  title="Editar" href="{{url("matricula/editar/$matriculas->id")}}">
                        <button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </a>
                        <a title="Deletar" href="{{url("matricula/excluir/$matriculas->id")}}" id="{{ $matriculas->id }}" data-method="DELETE" class="delete-btn">
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