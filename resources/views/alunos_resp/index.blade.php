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
            <h2>Alunos e Responsáveis Cadastrados no SisVILA</h2>
        </div>
    </div>
    <hr>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    <hr>
    @endif


    <h6>Lista de Alunos</h6>
    <table id="lista_alunos" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Instituição</th>
                <th>Série / Grupo</th>
                <th>CPF</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos_resp as $l)
                @if($l->tipo_aluno == 'ALUNO')
                    <tr>
                        <td>{{$l->id}}</td>
                        <td style="color: 
                        @if($l->status == '0')
                        red
                        @endif
                        ">
                        {{$l->nome_aluno}}</td>
                        <td>{{$l->local_aluno}}</td>
                        <td>{{$l->serie_aluno}}</td>
                        <td>{{$l->cpf_aluno}}</td>
                        <td>
                        @if ($l->status_aluno == "0")
                            <i class="fas fa-window-close" style="color: red;"></i>
                        @else
                            <i class="fas fa-check-square" style="color: green;"></i>
                        @endif
                    </td>
                        <td>
                            <a title="Ver Aluno" href="{{ route('aluno_resp.show', [$l->id]) }}">
                                <i class="fas fa-home" style="blue"></i>
                            </a>
                            <a title="Deletar Aluno" style="color: darkred;" href="{{ route('aluno_resp.delete', [$l->id]) }}">
                                <i class="fas fa-trash-alt btn-delete" style="blue"></i>
                            </a>
                            @if ($l->status_aluno == "0")
                                <a title="Habilitar Usuário" style="color: green" href="{{ route('aluno_resp.hab', [$l->id]) }}">
                                            <i class="fas fa-thumbs-up"></i> 
                                </a>
                                @else
                                    <a title="Desabilitar Usuário" style="color: red" href="{{ route('aluno_resp.desab', [$l->id]) }}">
                                                <i class="fas fa-thumbs-down"></i>
                                    </a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <hr>
    <h6>Lista de Responsáveis</h6>
    <table id="lista_resp" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
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
                @if($r->tipo_aluno == 'RESPONSÁVEL POR ALUNO')
                    <tr>
                        <td>{{$r->id}}</td>
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
                @endif
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