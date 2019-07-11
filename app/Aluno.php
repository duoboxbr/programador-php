<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Aluno extends Model {

    protected $fillable = [
        'id_aluno',
        'nm_aluno',
        'ds_email',
        'dt_nascimento'];

    protected $table = 'alunos';
    protected $primaryKey = 'id_aluno';

    public function matriculas() {
        $matriculas = $this->hasMany(Matricula::class, 'id_aluno');
        return $matriculas;
    }

    public function curso($id_curso) {
        $descricao = Curso::find($id_curso);
        return $descricao;
    }

    public static function indexLetraAluno($letra){
        return static::where('nm_aluno', 'LIKE', $letra.'%')->get();
    }

    public static function buscaNomeAluno($criterio){
        return static::where('nm_aluno', 'LIKE', '%'.$criterio.'%')->get();
    }

    public static function buscaEmailAluno($criterio){
        return static::where('ds_email', 'LIKE', '%'.$criterio.'%')->get();
    }
}
