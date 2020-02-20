@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-12">
         <h4 class="text-center">Cursos</h4>
         <hr>
         <table class="table table-bordred table-striped text-center">
            <thead class="thead-dark">
               <tr>
                  <th scope="col">Cursos</th>
                  <th scope="col">Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach($curso as $cursos)
               <tr>
                  <td>{{$cursos->curso}}</td>
                  <td>
                     <a title="Visualizar" href="{{url("curso/$cursos->id")}}">
                     <button class="btn btn-dark"><i class="fa fa-eye" aria-hidden="true"></i></button>
                     </a>
                     <a title="Editar" href="{{url("curso/editar/$cursos->id")}}">
                     <button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                     </a>
                     <a title="Deletar" href="{{url("curso/excluir/$cursos->id")}}" id="{{ $cursos->id }}" data-method="DELETE" class="delete-btn">
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