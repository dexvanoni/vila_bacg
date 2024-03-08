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
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <img src = "{{ asset('storage/usuarios/'.$usuario->arquivo) }}" class="img-fluid" style="max-width: 30%;">
                        </div>
                    </div>
                    
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
                            <strong>Telefone:</strong> {{$usuario->telefone}}
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
                                @else
                                    INATIVO 
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>É condutor de veículos?</strong> {{$usuario->condutor}}
                        </div>
                        <div class="col-md-2">
                            <strong>Nº CNH:</strong> {{$usuario->num_cnh}}
                        </div>
                        <div class="col-md-3">
                            <strong>Categoria CNH:</strong> {{$usuario->categoria_cnh}}
                        </div>
                        <div class="col-md-3">
                            <strong>Validade CNH:</strong> {{date('d/m/Y', strtotime($usuario->validade_cnh))}}
                        </div>
                    </div>
                    <hr>
                    <h6>Imagem da CNH enviada</h6>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <img src = "{{ asset('storage/usuarios_cnh/'.$usuario->arquivo_cnh) }}" class="img-fluid" style="max-width: 50%;">
                        </div>
                    </div>
                    <hr>
                    <h5>CONTROLES</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-danger" title="Excluir Usuário" href="{{ route('usuarios.delete', [$usuario->id]) }}">
                                <i class="fas fa-trash-alt"></i> EXCLUIR
                            </a>
                            <a class="btn btn-secondary" title="Editar cadastro" href="{{ route('usuarios.edit', [$usuario->id]) }}">
                                <i class="fas fa-user-edit"></i> EDITAR
                            </a>
                        <!--<a title="QR-Code" href="{{ route('qrcode_organico', [$usuario->id]) }}">
                                <i class="fas fa-qrcode" style="color: green; margin-left: 10PX;"></i>
                        </a>-->
                        @if($usuario->autorizacao <> 'po')
                            <a title="QR-Code" class="btn btn-success" href="#" data-toggle="modal" data-target="#QRView-<?php echo $usuario->id; ?>">
                                <i class="fas fa-qrcode"></i> QR-CODE
                            </a>
                        @endif
                        @if($usuario->status == 1)
                                <a title="Desabilitar Usuário" class="btn btn-warning" href="{{ route('usuarios.desab', [$usuario->id]) }}">
                                    <i class="fas fa-dizzy"></i> Desabilitar
                                </a>
                                @else
                                <a title="Habilitar Usuário" class="btn btn-info" href="{{ route('usuarios.hab', [$usuario->id]) }}">
                                    <i class="fas fa-smile"></i> Habilitar
                                </a>
                            @endif
                        </div>
                         
                    </div>
                    <!--MODAL QUE EXIBE O QR-CODE-->
                                <div class="modal fade" id="QRView-<?=$usuario->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>Usuário: {{$usuario->name}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         {!! QrCode::size(300)->generate($usuario->cpf) !!}
                                         
                                      </div>
                                      <div class="modal-footer">

                                        <a title="QR-Code" href="{{ route('qrcode_organico', [$usuario->cpf]) }}">
                                           Imprimir
                                        </a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--FIM DO MODAL-->

                </div>
            </div>
        </div>
    </div>
</div>  

@endsection
