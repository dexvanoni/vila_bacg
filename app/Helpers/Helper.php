<?php

namespace App\Helpers;

use Auth;

class Helper
{
    public static function busca_perfil()
    {
        $perfis = [
            'ad' => 'Administrador',
            'pe' => 'Permissionário',
            'de' => 'Dependente',
            'st' => 'Sócio-Titular',
            'sd' => 'Sócio-Dependente',
            'fe' => 'Funcionário Escola',
            'ra' => 'Responsável por Aluno',
            'ps' => 'Prestador de Serviço',
            'po' => 'Portaria',
            'si' => 'Síndico',
            'in' => 'Inteligência',
            // Adicione mais tipos de perfis aqui conforme necessário
        ];

        $perfisUsuario = 'Visitante'; // Perfil padrão se o usuário não estiver autenticado

        if (auth()->check()) {
            $usuarioPerfis = explode(',', auth()->user()->autorizacao);
            foreach ($usuarioPerfis as $perfil) {
                if (array_key_exists($perfil, $perfis)) {
                    $perfisUsuario = $perfis[$perfil];
                    break; // Para assim que um perfil for encontrado
                }
            }
        }

        return $perfisUsuario;
    }
}