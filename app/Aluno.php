<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model{
    protected $fillable   = ['nome', 'email', 'data_nascimento'];
}
