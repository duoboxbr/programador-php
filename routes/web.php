<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

route::group(['prefix' => 'aluno'], function () {
    route::get('/', 'AlunosController@aluno');
    route::get('/novo', 'AlunosController@addAluno');
    route::get('/{id_aluno}/editar', 'AlunosController@editAluno');
    route::get('/{id_aluno}/excluir', 'AlunosController@delAluno');
    route::get('/{id_aluno}/destroyAluno', 'AlunosController@destroyAluno');
    route::post('/savealuno','AlunosController@saveAluno');
    route::post('/updatealuno','AlunosController@updateAluno');
    route::post('/buscaNome', 'AlunosController@buscaNomeAluno');
    route::post('/buscaEmail', 'AlunosController@buscaEmailAluno');
    route::get('/{letra}", "AlunosController@alunoLetra');
    });

route::group(['prefix' => 'curso'], function () {
    route::get('/', 'CursosController@curso');
    route::get('/novo', 'CursosController@addCurso');
    route::get('/{id_curso}/editar', 'CursosController@editCurso');
    route::get('/{id_curso}/excluir', 'CursosController@delCurso');
    route::get('/{id_curso}/destroyCurso', 'CursosController@destroyCurso');
    route::post('/savecurso', 'CursosController@saveCurso');
    route::post('/updatecurso','CursosController@updateCurso');
    route::post('/busca', 'CursosController@buscaCurso');
    route::get('/{letra}', 'CursosController@cursoLetra');
});

route::group(['prefix' => 'matricula'], function () {
    route::get('/', 'MatriculasController@matricula');
    route::get('/novo/{id_aluno}', 'MatriculasController@addMatricula');
    route::get('/{id_aluno}/excluir/{id_matricula}', 'MatriculasController@delMatricula');
    route::get('/destroyMatricula/{id_matricula}', 'MatriculasController@destroyMatricula');
    route::post('/savematricula', 'MatriculasController@saveMatricula');
});


