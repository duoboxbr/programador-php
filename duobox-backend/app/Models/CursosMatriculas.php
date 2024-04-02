<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosMatriculas extends Model
{
    use HasFactory;

    protected $fillable = ['curso_id', 'aluno_id'];

    public function cursos()
    {
        return $this->belongsTo(Cursos::class);
    }

    public function alunos()
    {
        return $this->belongsTo(Alunos::class);
    }
}
