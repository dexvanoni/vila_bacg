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

    <table id="lista_resp" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
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
                        <td><input type="checkbox" name="selected[]" value="{{ $r->id }}"></td>
                        <td style="color: 
                        @if($r->status == '0')
                        red
                        @endif
                        ">
                        {{$r->nome_resp}}</td>
                        <td>{{$r->nome_aluno_resp}}</td>
                        <td>{{$r->tel_resp}}</td>
                        <td>{{$r->cpf_resp}}</td>
                        <td>
                        @if ($r->status_aluno == "0")
                            <i class="fas fa-window-close" style="color: red;"></i>
                        @else
                            <i class="fas fa-check-square" style="color: green;"></i>
                        @endif
                    </td>
                        <td>
                            <a title="Ver Usuário" href="{{ route('aluno_resp.show', [$r->id]) }}">
                                <i class="fas fa-home" style="blue"></i>
                            </a>
                            <a title="Deletar Responsável" style="color: darkred;" href="{{ route('aluno_resp.delete', [$r->id]) }}">
                                <i class="fas fa-trash-alt btn-delete" style="blue"></i>
                            </a>
                            @if ($r->status_aluno == "0")
                                <a title="Habilitar Usuário" style="color: green" href="{{ route('aluno_resp.hab', [$r->id]) }}">
                                            <i class="fas fa-thumbs-up"></i> 
                                </a>
                                @else
                                    <a title="Desabilitar Usuário" style="color: red" href="{{ route('aluno_resp.desab', [$r->id]) }}">
                                                <i class="fas fa-thumbs-down"></i>
                                    </a>
                            @endif
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>

    <a title="Imprimir Crachás em Massa" href="{{ route('crachas') }}">
        <i class="fas fa-print"></i> Impressão de Crachás dos Alunos e Responsáveis
    </a>
</div>

<script type="text/javascript">

</script>
@endsection