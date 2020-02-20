@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <h4 class="text-center">Sobre o Curso</h4>
         <hr>
         <div class="card">
            <div class="card-body">
               <strong>Curso:</strong> {{$curso->curso}}<br>
               <strong>Descrição:</strong> {{$curso->descricao}}<br>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection