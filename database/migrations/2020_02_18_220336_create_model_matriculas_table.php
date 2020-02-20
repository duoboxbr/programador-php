<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::create('tb_matriculas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_aluno')->unsigned();
            $table->bigInteger('id_curso')->unsigned();
            $table->foreign('id_aluno')->references('id')->on('tb_alunos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_curso')->references('id')->on('tb_cursos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_matriculas');
    }
}
