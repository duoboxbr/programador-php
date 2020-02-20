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

Route::resource('/cursos', 'CursoController');
Route::resource('/alunos', 'AlunoController');
Route::resource('/matriculas', 'MatriculaController');

route::group(['prefix' => 'curso'], function () {
    route::get('/', 'CursoController@index');
    route::get('/cadastrar', 'CursoController@create');
    route::get('/{id}', 'CursoController@show');
    route::post('/salvar', 'CursoController@store');
    route::get('/editar/{id}', 'CursoController@edit');
    route::put('/editar/{id}', 'CursoController@update');
    route::delete('/excluir/{id}', 'CursoController@destroy');
});

route::group(['prefix' => 'aluno'], function () {
    route::get('/', 'AlunoController@index');
    route::get('/buscar_nome', 'AlunoController@buscarNome');
    route::get('/buscar_email', 'AlunoController@buscarEmail');
    route::get('/cadastrar', 'AlunoController@create');
    route::post('/salvar', 'AlunoController@store');
    route::get('/{id}', 'AlunoController@show');
    route::get('/editar/{id}', 'AlunoController@edit');
    route::put('/editar/{id}', 'AlunoController@update');
    route::delete('/excluir/{id}', 'AlunoController@destroy');
});

route::group(['prefix' => 'matricula'], function () {
    route::get('/', 'MatriculaController@index');
    route::get('/cadastrar', 'MatriculaController@create');
    route::post('/salvar', 'MatriculaController@store');
    route::get('/{id}', 'MatriculaController@show');
    route::get('/editar/{id}', 'MatriculaController@edit');
    route::put('/editar/{id}', 'MatriculaController@update');
    route::delete('/excluir/{id}', 'MatriculaController@destroy');
});
