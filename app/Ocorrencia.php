<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    protected $table = 'ocorrencias';
    protected $fillable = [

        'dono', 'mensagem', 'status', 'a_quem', 'prioridade', 'arquivo'

    ];
}
