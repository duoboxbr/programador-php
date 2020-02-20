@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <h4 class="text-center">Sobre a Matrícula</h4>
         <hr>
         <div class="card">
            <div class="card-body">
               @php
               $aluno=$matricula->find($matricula->id)->relAlunos;
               $curso=$matricula->find($matricula->id)->relCursos;
               @endphp
               <strong>Nome:</strong> {{$aluno->nome}}<br>
               <strong>Curso:</strong> {{$curso->curso}}<br>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection