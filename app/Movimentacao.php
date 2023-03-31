<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'movimentacao';
    protected $fillable = [

        'morador_id', 'movimento'
        
    ];
}
