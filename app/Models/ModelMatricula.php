<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMatricula extends Model
{
    protected $table = 'tb_matriculas';
	protected $fillable=['id_aluno','id_curso'];

    public function relAlunos()
    {
        return $this->hasOne('App\Models\ModelAluno','id','id_aluno');
    }

        public function relCursos()
    {
        return $this->hasOne('App\Models\ModelCurso','id','id_curso');
    }
}
