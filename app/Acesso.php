<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    protected $fillable = [

        'dono', 'titulo', 'mensagem', 'duracao', 'a_quem', 'arquivo', 'prioridade'

    ];
}
