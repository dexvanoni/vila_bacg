@extends('layouts.app')

@section('content')
@php

@endphp
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
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
    <table id="lista_usuarios" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nome Completo</th>
                <th>CPF</th>
                <th>Função</th>
                <th>Status</th>
                @if (Auth::user()->autorizacao <> 'po')
                    <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $l)
                <tr>
                    <td style="color: 
                        @if($l->status == "0")
                            red
                        @endif
                            ">
                            {{$l->name}}</td>
                    <td>{{$l->cpf}}</td>
                    <td>
                        @switch($l->autorizacao)
                                @case('ad')
                                    Administrador
                                    @break
                                @case('mo')
                                    Morador
                                    @break
                                @case('so')
                                    Sócio
                                    @break
                                @case('fe')
                                    Funcionário Escola
                                    @break
                                @case('ef')
                                    Efetivo BACG
                                    @break
                                @case('ra')
                                    Responsável por Aluno
                                    @break
                                @case('al')
                                    Aluno
                                    @break
                                @case('po')
                                    Portaria
                                    @break
                                @default
                                    Desconhecido
                            @endswitch
                    </td>
                    <td>
                        @if ($l->status == "0")
                            <i class="fas fa-window-close" style="color: red;" title="DESABILITADO NO SISTEMA"></i>
                        @else
                            <i class="fas fa-check-square" style="color: green;" title="HABILITADO NO SISTEMA"></i>
                        @endif

                        @if ($l->parecer_sint == 'APROVADO')
                            <i class="fas fa-user-secret" style="color: green;" title="APROVADO PELA SINT"></i>
                        @elseif ($l->parecer_sint == 'RECUSADO')
                            <i class="fas fa-user-secret" style="color: red;" title="RECUSADO PELA SINT"></i>
                        @else
                            <i class="fas fa-user-secret" style="color: grey;"></i>
                        @endif
                    </td>
                    @if (Auth::user()->autorizacao <> 'po')
                    <td>
                        <a title="Ver Usuário" style="color: black" href="{{ route('usuarios.show', [$l->id]) }}">
                            <i class="fas fa-home" style="blue"></i>
                        </a>
                        <a title="Deletar Usuário" style="color: darkred;" href="{{ route('usuarios.delete', [$l->id]) }}">
                            <i class="fas fa-trash-alt btn-delete" style="blue"></i>
                        </a>
                        @if ($l->status == "0")
                            <a title="Habilitar Usuário" style="color: green" href="{{ route('usuarios.hab', [$l->id]) }}">
                                        <i class="fas fa-thumbs-up"></i> 
                            </a>
                        @else
                            <a title="Desabilitar Usuário" style="color: red" href="{{ route('usuarios.desab', [$l->id]) }}">
                                        <i class="fas fa-thumbs-down"></i>
                            </a>
                        @endif
                        @if (Auth::user()->funcao == 'in')
                            <a title="Parecer SINT" style="color: red" href="{{ route('usuarios.parecer_sint', [$l->id]) }}">
                                        <i class="fas fa-user-secret" style="color: blue;"></i>
                            </a>
                        @endif
                    </td>
                    @endif
                </tr>
                
            @endforeach
        </tbody>
    </table>

    <a title="Imprimir Crachás em Massa" href="{{ route('crachas') }}">
        <i class="fas fa-print"></i> Impressão de Crachás
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                if (!confirm('Tem certeza que deseja excluir este usuário?')) {
                    event.preventDefault(); // Cancela o evento de clique se o usuário escolher "Cancelar"
                }
            });
        });
    });
</script>
@endsection