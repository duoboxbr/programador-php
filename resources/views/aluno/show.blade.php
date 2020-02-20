@extends('templates.template')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <h4 class="text-center">Sobre o Aluno</h4>
         <hr>
         <div class="card">
            <div class="card-body">
               <strong>Nome:</strong> {{$aluno->nome}}<br>
               <strong>E-mail:</strong> {{$aluno->email}}<br>
               <strong>Data de Nascimento:</strong> {{ date('d/m/Y', strtotime($aluno->data_nascimento)) }}<br>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection