<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $table = 'lista_ingresso';
    protected $fillable = [

        'portao', 'dt_evento', 'hr_evento', 'qtn', 'arquivo', 'local_evento', 'dono', 'onesignal_portaria'
        
    ];
}
