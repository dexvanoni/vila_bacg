@extends('layouts.app')
@section('perfil')
  @php
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
                } elseif ($info == 'al') {
                  $perfis->push('Aluno');
                }
                $perfis->all();
              }
  @endphp
@endsection