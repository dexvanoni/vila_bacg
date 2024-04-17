<?php

namespace App\Http\Middleware;

use Closure;

class Socio_Dependente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $perfis = collect([]);
              foreach(explode(',',  Auth::user()->autorizacao) as $info){
                if ($info == 'pe') {
                  $perfis->push('Permissionário');
                } elseif ($info == 'de') {
                  $perfis->push('Dependente');
                } elseif ($info == 'st') {
                  $perfis->push('Sócio-Titular');
                } elseif ($info == 'sd') {
                  $perfis->push('Sócio-Dependente');
                } elseif ($info == 'fe') {
                  $perfis->push('Funcionário da Escola');
                } elseif ($info == 'ra') {
                  $perfis->push('Responsável por Aluno');
                } elseif ($info == 'ps') {
                  $perfis->push('Prestador de Serviço');
                } elseif ($info == 'po') {
                  $perfis->push('Portaria');
                } elseif ($info == 'si') {
                  $perfis->push('Síndico');
                } elseif ($info == 'ad') {
                  $perfis->push('Administrador');
                }
                $perfis->all();
              }
            if(!$perfis->contains('Sócio-Dependente')) {
                return redirect('home');
            }
         return $next($request);
    }
}
