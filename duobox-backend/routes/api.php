<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\CursosMatriculasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(CursosController::class)->group(function() {
    Route::get('cursos', 'getCursos');
    Route::post('curso', 'store');
    Route::put('curso/{cursoId}', 'update');
    Route::delete('curso/{cursoId}', 'delete');
});

Route::controller(AlunosController::class)->group(function() {
    Route::get('alunos', 'getAlunos');
    Route::get('alunos-matriculados/{cursoId}', 'getAlunosMatriculados');
    Route::post('aluno', 'store');
    Route::put('matricular-aluno/{alunoId}', 'matricular');
    Route::put('aluno/{alunoId}', 'update');
    Route::delete('aluno/{alunoId}', 'delete');
    Route::delete('remover-matricula/{alunoId}', 'removerMatricula');
});
