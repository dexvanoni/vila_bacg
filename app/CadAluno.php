<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CadAluno extends Model
{

    protected $table = "alunos";
    protected $fillable = [

            'nome_aluno',
            'local_aluno',
            'dt_nascimento_aluno',
            'serie_aluno',
            'cpf_aluno',
            'rg_aluno',
            'rua_aluno',
            'num_casa_aluno',
            'bairro_aluno',
            'cidade_aluno',
            'cep_aluno',
            'status_aluno',
            'tipo_aluno',
            'arquivo_aluno',
            'nome_resp', 
            'nome_aluno_resp',
            'cpf_aluno_resp',
            'cpf_resp',
            'rg_resp',
            'num_cnh_resp',
            'tipo_cnh_resp',
            'validade_cnh_resp',
            'rua_resp',
            'num_casa_resp',
            'bairro_resp',
            'cidade_resp',
            'cep_resp',
            'arquivo_resp',
            'tel_resp',
            'email_resp',
            'arquivo_cnh_resp',
            'parecer_sint',
            'motivo_sint',
            'controle_email'
    ];
}
