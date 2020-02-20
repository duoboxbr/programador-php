<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCurso extends Model
{
    protected $table = 'tb_cursos';
    protected $fillable=['curso','descricao'];
    
}
