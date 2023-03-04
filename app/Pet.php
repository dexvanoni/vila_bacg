<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';
    protected $fillable = [

        'dono', 'tipo', 'coleira', 'contato', 'porte', 'arquivo', 'raca', 'cor'

    ];
}
