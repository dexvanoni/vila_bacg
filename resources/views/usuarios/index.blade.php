@extends('layouts.app')

@section('content')
@php

@endphp
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila.png" width="100px" height="70px">        
        </div>
        <div class="col-md-12">
            <h2>Usuários do SisVILA</h2>
        </div>
    </div>
    <hr>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        <hr>
    @endif
    <table id="listas" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nome Completo</th>
                <th>Email(login)</th>
                <th>Local</th>
                <th>Contatos</th>
                <th>Perfil</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $l)
                @php
                    $perfis = collect([]);
                      foreach(explode(',',  $l->autorizacao) as $info){
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
                <tr>
                    <td>{{$l->name}}</td>
                    <td>{{$l->email}}</td>
                    <td>{{$l->local}}</td>
                    <td>{{$l->telefone}} / {{$l->ramal}}</td>
                    <td>@foreach($perfis as $p)
                          {{$p}}<br><br>
                        @endforeach
                    </td>
                    <td>{{$l->cpf}}</td>
                    @if($l->status == 1)
                    <td>
                        <a title="Ver Usuário" href="{{ route('usuarios.show', [$l->id]) }}">
                            <i class="fas fa-home" style="blue"></i>
                        </a>
                        <a title="Excluir Usuário" href="{{ route('usuarios.delete', [$l->id]) }}">
                                <i class="fas fa-trash-alt" style="color: red; margin-left: 10PX;"></i>
                        </a>
                        <a title="Desabilitar Usuário" href="{{ route('usuarios.desab', [$l->id]) }}">
                                <i class="fas fa-dizzy" style="color: black; margin-left: 10PX;"></i>
                        </a>
                        <!--<a title="QR-Code" href="{{ route('qrcode_organico', [$l->id]) }}">
                                <i class="fas fa-qrcode" style="color: green; margin-left: 10PX;"></i>
                        </a>-->
                        @if(!$perfis->contains('Portaria'))
                            <a title="QR-Code" href="#" data-toggle="modal" data-target="#QRView-<?php echo $l->id; ?>">
                                <i class="fas fa-qrcode" style="color: green; margin-left: 1rem;"></i>
                            </a>
                        @endif
                    </td>
                    @else
                    <td>
                        <a title="Excluir Usuário" href="{{ route('usuarios.delete', [$l->id]) }}">
                                <i class="fas fa-trash-alt" style="color: red; margin-left: 10PX;"></i>
                        </a>
                        <a title="Habilitar Usuário" href="{{ route('usuarios.hab', [$l->id]) }}">
                                <i class="fas fa-smile" style="color: green; margin-left: 10PX;"></i>
                        </a>
                    </td>
                    @endif
                </tr>
                <!--MODAL QUE EXIBE O QR-CODE-->
                                <div class="modal fade" id="QRView-<?=$l->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>Usuário: {{$l->name}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         {!! QrCode::size(300)->generate($l->id) !!}
                                         
                                      </div>
                                      <div class="modal-footer">

                                        <a title="QR-Code" href="{{ route('qrcode_organico', [$l->id]) }}">
                                           Imprimir
                                        </a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--FIM DO MODAL-->
            @endforeach
        </tbody>
    </table>

    
</div>
@endsection
