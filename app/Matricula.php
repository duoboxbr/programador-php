<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model {
    protected $fillable = [
        'id_matricula',
        'id_aluno',
        'id_curso'
    ];

    protected $table = 'matriculas';
    protected $primaryKey = 'id_matricula';
}
