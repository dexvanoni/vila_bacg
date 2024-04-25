<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Administrador
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
                if ($info == 'mo') {
                  $perfis->push('Morador');
                } elseif ($info == 'so') {
                  $perfis->push('Sócio');
                } elseif ($info == 'al') {
                  $perfis->push('Aluno');
                } elseif ($info == 'ef') {
                  $perfis->push('Efetivo BACG');
                } elseif ($info == 'fe') {
                  $perfis->push('Funcionário da Escola');
                } elseif ($info == 'ra') {
                  $perfis->push('Responsável por Aluno');
                } elseif ($info == 'po') {
                  $perfis->push('Portaria');
                } elseif ($info == 'ad') {
                  $perfis->push('Administrador');
                }
                $perfis->all();
              }
            if(!$perfis->contains('Administrador')) {
                return redirect('home');
            }
         return $next($request);
    }
}
