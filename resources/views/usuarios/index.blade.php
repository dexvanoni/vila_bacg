@extends('layouts.app')

@section('content')
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
    @if(session('erro'))
        <div class="alert alert-danger" role="alert">
            {{ session('erro') }}
        </div>
        <hr>
    @endif
    <div class="row">
        <h4>Ações para vários registros</h4>
    </div>
    <div class="row">
        <div class="col-1">
            <button id="ativaSelected" title="ATIVAR TODOS SELECIONADOS" class="btn btn-success"><i class="fas fa-chart-line"></i></button>
        </div>
        <div class="col-1">
            <button id="desativaSelected" title="DESATIVAR TODOS SELECIONADOS" class="btn btn-warning"><i class="fas fa-user-slash"></i></button>
        </div>
            <div class="col-1">
                <button id="deleteSelected" title="APAGAR TODOS SELECIONADOS" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            </div>
    </div>
<hr>
    <div class="row">
        <div class="col-12">
            <input type="checkbox" id="selectAll" /> Selecionar tudo
        </div>
    </div>

    <div class="row">
        

    
    <table id="lista_usuarios" class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Nome Completo</th>
                <th>CPF</th>
                <th>Local</th>
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
                    <td><input type="checkbox" name="selected[]" value="{{ $l->id }}"></td>
                    <td>{{$l->name}}</td>
                    <td>{{$l->cpf}}</td>
                    <td>{{$l->local}}</td>
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
                            <i class="fas fa-user-secret" style="color: green;" title="{{ $l->motivo_sint }}"></i>
                        @elseif ($l->parecer_sint == 'RECUSADO')
                            <i class="fas fa-user-secret" style="color: red;" title="{{ $l->motivo_sint }}"></i>
                        @else
                            <i class="fas fa-user-secret" style="color: grey;"></i>
                        @endif
                    </td>
                    @if (Auth::user()->autorizacao <> 'po')
                    <td>
                        <a title="Ver Usuário" style="color: black" href="{{ route('usuarios.show', [$l->id]) }}">
                            <i class="fas fa-home" ></i>
                        </a>
                        <a title="Deletar Usuário" style="color: darkred;" href="{{ route('usuarios.delete', [$l->id]) }}">
                            <i class="fas fa-trash-alt btn-delete" ></i>
                        </a>
                        <a title="DESATIVAR Usuário" style="color: saddlebrown;" href="{{ route('usuarios.desativa', [$l->id]) }}">
                            <i class="fas fa-user-slash btn-desabilita"></i>
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
                        @if ($l->status == "1")
                            @if($l->controle_email > 0)
                            <a title="Enviar EMAIL ao Usuário com seu QR-Code" style="color: purple;" href="{{ route('email_qrcode_meuqr', [$l->id]) }}">
                                        <i class="far fa-envelope btn-mail">+{{ $l->controle_email }}</i>
                            </a>
                            @else
                            <a title="Enviar EMAIL ao Usuário com seu QR-Code" style="color: green" href="{{ route('email_qrcode_meuqr', [$l->id]) }}">
                                        <i class="far fa-envelope btn-mail"></i>
                            </a>
                            @endif
                        @endif
                    </td>
                    @endif
                </tr>
                
            @endforeach
        </tbody>
    </table>
        </div>

        <div class="row">
            <div class="col">
                <a title="Ver usuários DESABILITADOS do SisVila" href="{{ route('usuarios.index_desabilitados') }}">
                    <i class="fas fa-user-slash"></i> Usuários DESABILITADOS
                </a>
            </div>
            <div class="col">
                <div id="btn-place"></div>
            </div>
        </div>
    
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

    document.addEventListener('DOMContentLoaded', function() {
        var desabilitaButtons = document.querySelectorAll('.btn-desabilita');
        desabilitaButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                if (!confirm('Tem certeza que deseja DESABILITAR este usuário?')) {
                    event.preventDefault(); // Cancela o evento de clique se o usuário escolher "Cancelar"
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var mailButtons = document.querySelectorAll('.btn-mail');
        mailButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                if (!confirm('Tem certeza que deseja ENVIAR O CARTÃO DE ACESSO NO EMAIL deste usuário?')) {
                    event.preventDefault(); // Cancela o evento de clique se o usuário escolher "Cancelar"
                }
            });
        });
    });


</script>

@endsection