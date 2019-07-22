<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model{
    protected $fillable = ['curso_id', 'aluno_id'];
}
