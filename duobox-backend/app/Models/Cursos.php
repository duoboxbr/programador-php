<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao'];

    public function alunos()
    {
        return $this->hasMany(Alunos::class);
    }
}
