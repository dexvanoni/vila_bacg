<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailEscola extends Model
{
    protected $table = 'mailescolas';
    protected $fillable = [

        'emei', 'escola'
        
    ];
}
