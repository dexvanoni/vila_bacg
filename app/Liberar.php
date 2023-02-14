<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liberar extends Model
{
    protected $table = 'cad_vis_entrada';
    protected $fillable = [

        'apelido', 'nome_completo', 'doc', 'funcao', 'veiculo', 'cor_veiculo', 'liberador', 'destino', 'dt_entrada', 'dt_saida', 'hr_entrada', 'hr_saida', 'status', 'observacao', 'onesignal_id', 'dt_entrou', 'dt_saiu', 'hr_entrou', 'hr_saiu', 'movimentacao'
        
    ];
}
