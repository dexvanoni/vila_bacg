<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locais';
    protected $fillable = [

        'local', 'tipo', 'responsavel', 'status', 'arquivo'
        
    ];
}
