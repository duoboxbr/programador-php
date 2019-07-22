<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Teste Doubox</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  <script src="{{ asset('js/jquery.js') }}" type="text/js"></script>
  <script src="{{ asset('js/jquery.maskedinput-1.3.min.js') }}" type="text/js"></script>
  <script src="{{ asset('js/aluno.js') }}" type="text/js"></script>
</head>
<body>
  <div class="container">
    <br>
    <a href="/alunos" class="btn btn-primary">Alunos</a>
    <a href="/cursos" class="btn btn-primary">Cursos</a>
    <a href="/matriculas" class="btn btn-primary">Matriculas</a>
    @yield('content')
  </div>
</body>
</html>
