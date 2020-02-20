<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAluno extends Model
{
    protected $table = 'tb_alunos';
    protected $fillable=['nome','email','data_nascimento'];
     
}


