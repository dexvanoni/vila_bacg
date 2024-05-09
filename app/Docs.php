<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docs extends Model
{
    protected $table = "docs";
    protected $fillable = [
            'dt',
            'doc',
            'obs'
    ];
}
