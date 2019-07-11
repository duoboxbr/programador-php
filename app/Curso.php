<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model {

    protected $fillable = [
        'id_curso',
        'nm_curso',
        'ds_curso'];

    protected $table = 'cursos';
    protected $primaryKey = 'id_curso';

    public static function indexLetraCurso($letra){
        return static::where('nm_curso', 'LIKE', $letra.'%')->get();
    }

    public static function buscaNomeCurso($criterio){
        return static::where('nm_curso', 'LIKE', '%'.$criterio.'%')->get();
    }

}
