@extends('layouts.app')

@php
 $perfis = collect([]);
                      foreach(explode(',',  $usuario->autorizacao) as $info){
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
@endphp

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila.png" width="100px" height="70px">        
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Usuário: {{$usuario->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                           <strong>Nome:</strong> {{$usuario->name}}
                        </div>
                        <div class="col-md-2">
                            <strong>RG:</strong> {{$usuario->rg}}
                        </div>
                        <div class="col-md-3">
                            <strong>CPF:</strong> {{$usuario->cpf}}
                        </div>
                        <div class="col-md-3">
                            <strong>Telefone:</strong> {{$usuario->telefone}} <strong>- Ramal:</strong> {{$usuario->ramal}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>E-mail:</strong> {{$usuario->email}}
                        </div>
                        <div class="col-md-2">
                            <strong>Local:</strong> {{$usuario->local}}
                        </div>
                        <div class="col-md-3">
                            <strong>Perfil:</strong> 
                            @foreach($perfis as $p)
                                {{$p}}
                            @endforeach
                        </div>
                        <div class="col-md-3">
                            <strong>Status:</strong>
                            @if($usuario->status == 1)
                                ATIVO
                                <a title="Desabilitar Usuário" href="{{ route('usuarios.desab', [$usuario->id]) }}">
                                    <i class="fas fa-dizzy" style="color: black; margin-left: 3PX;"></i>
                                </a>
                                @else
                                INATIVO 
                                <a title="Habilitar Usuário" href="{{ route('usuarios.hab', [$usuario->id]) }}">
                                    <i class="fas fa-smile" style="color: green; margin-left: 10PX;"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>  

@endsection
