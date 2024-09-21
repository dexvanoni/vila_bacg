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
            <h2>Responsáveis por Alunos Cadastrados no SisVILA</h2>
        </div>
    </div>
    <hr>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    <hr>
    @endif

    @if (Auth::user()->autorizacao == 'ad')
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
    @endif
    

    <table id="lista_resp" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Nome do Responsável</th>
                <th>Aluno</th>
                <th>Whatsapp</th>
                <th>CPF</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos_resp as $r)
                    <tr>
                        @if (Auth::user()->autorizacao == 'ad')
                            <td><input type="checkbox" name="selected[]" value="{{ $r->id }}"></td>
                        @endif
                        <td>
                        {{$r->nome_resp}}
                        @if ($r->parecer_escola == null && Auth::user()->autorizacao == 'fe')
                            <i title="Aluno/Responsável sem parecer" class="fas fa-lightbulb" style="color: red;"></i>
                        @endif
                        @if ($r->parecer_sint == null && Auth::user()->funcao == 'in')
                            <i title="Aluno/Responsável sem parecer" class="fas fa-lightbulb" style="color: red;"></i>
                        @endif
                        </td>
                        <td>{{$r->nome_aluno_resp}}</td>
                        <td>{{$r->tel_resp}}</td>
                        <td>{{$r->cpf_resp}}</td>
                        <td>
                        @if ($r->status_aluno == "0")
                            <i class="fas fa-window-close" style="color: red;" title="BLOQUEADO PELO ADMINISTRADOR"></i>
                        @else
                            <i class="fas fa-check-square" style="color: green;" title="LIBERADO PELO ADMINISTRADOR"></i>
                        @endif
                        @if ($r->parecer_sint == 'APROVADO')
                            <i class="fas fa-user-secret" style="color: green;" title="{{ $r->motivo_sint }}"></i>
                        @elseif ($r->parecer_sint == 'RECUSADO')
                            <i class="fas fa-user-secret" style="color: red;" title="{{ $r->motivo_sint }}"></i>
                        @else
                            <i class="fas fa-user-secret" style="color: grey;"></i>
                        @endif
                        @if ($r->parecer_escola == 'APROVADO')
                            <i class="fas fa-child" style="color: green;" title="{{ $r->motivo_escola }}"></i>
                        @elseif ($r->parecer_escola == 'RECUSADO')
                            <i class="fas fa-child" style="color: red;" title="{{ $r->motivo_escola }}"></i>
                        @else
                            <i class="fas fa-child" style="color: grey;"></i>
                        @endif
                    </td>
                        <td>
                            @if (Auth::user()->autorizacao == 'ad')
                            <a title="Ver Usuário" href="{{ route('aluno_resp.show_resp', [$r->id]) }}">
                                <i class="fas fa-home" style="blue"></i>
                            </a>
                            <a title="Deletar Responsável" style="color: darkred;" href="{{ route('aluno_resp.delete', [$r->id]) }}">
                                <i class="fas fa-trash-alt btn-delete" style="blue"></i>
                            </a>
                            @if($r->status_aluno == '2')
                                <a title="REATIVAR Aluno/Resp" style="color: saddlebrown;" href="{{ route('aluno_resp.reativa', [$r->id]) }}">
                                    <i class="fas fa-user-plus btn-reativa"></i>
                                </a>
                                @else
                                <a title="DESATIVAR Aluno/Resp" style="color: saddlebrown;" href="{{ route('aluno_resp.desativa', [$r->id]) }}">
                                    <i class="fas fa-user-slash btn-desabilita"></i>
                                </a>
                            @endif
                                @if ($r->status_aluno == "0")
                                    <a title="Habilitar Usuário" style="color: green" href="{{ route('aluno_resp.hab', [$r->id]) }}">
                                                <i class="fas fa-thumbs-up"></i> 
                                    </a>
                                    @else
                                        <a title="Desabilitar Usuário" style="color: red" href="{{ route('aluno_resp.desab', [$r->id]) }}">
                                                    <i class="fas fa-thumbs-down"></i>
                                        </a>
                                @endif
                            @endif
                             @if (Auth::user()->funcao == 'in')
                            <a title="Parecer SINT" style="color: red" href="{{ route('aluno_resp.parecer_sint_aluno', [$r->id]) }}">
                                        <i class="fas fa-user-secret" style="color: blue;"></i>
                            </a>
                            @endif
                             @if (Auth::user()->funcao == 'APYJUCA')
                            <a title="Aprovação Escola" style="color: orange" href="{{ route('aluno_resp.parecer_escola_aluno', [$r->id]) }}">
                                        <i class="fas fa-child"></i>
                            </a>
                            @endif
                            @if (Auth::user()->funcao == 'APEMEI')
                            <a title="Aprovação EMEI" style="color: orange" href="{{ route('aluno_resp.parecer_escola_aluno', [$r->id]) }}">
                                        <i class="fas fa-baby"></i>
                            </a>
                            @endif
                            @if ($r->status_aluno == "1")
                            <a title="Enviar EMAIL ao aluno com seu QR-Code" style="color: green" href="{{ route('email_qrcode_meuqr_aluno', [$r->id]) }}">
                                        <i class="far fa-envelope btn-mail"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>

        <div class="row">
            <div class="col">
                <a title="Ver Responsáveis por alunos DESABILITADOS do SisVila" href="{{ route('aluno_resp.index_desabilitados_resp') }}">
                    <i class="fas fa-user-slash"></i> Responsáveis DESABILITADOS
                </a>
            </div>
            <div class="col">
                <div id="btn-place"></div>
            </div>
        </div>
</div>

<script type="text/javascript">

</script>
@endsection