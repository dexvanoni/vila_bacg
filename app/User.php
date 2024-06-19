<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nascimento', 'email', 'password', 'autorizacao', 'local', 'onesignal_id', 'telefone', 'cpf', 'rg', 'status', 'arquivo', 'condutor', 'num_cnh','validade_cnh', 'categoria_cnh', 'arquivo_cnh', 'cep_func', 'rua_func', 'num_casa_func', 'bairro_func', 'cidade_func', 'parecer_sint', 'motivo_sint', 'controle_email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $username = 'cpf';
}
