<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'dat_nascimento'];

    public function curso()
    {
        return $this->belongsTo(Cursos::class);
    }
}
