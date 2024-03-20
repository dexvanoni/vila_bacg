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
    <table id="lista_usuarios" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nome Completo</th>
                <th>CPF</th>
                <th>Status</th>
                <th>Ações</th>
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
                        @if ($l->status == "0")
                            <i class="fas fa-window-close" style="color: red;"></i>
                        @else
                            <i class="fas fa-check-square" style="color: green;"></i>
                        @endif
                    </td>
                    <td>
                        <a title="Ver Usuário" style="color: black" href="{{ route('usuarios.show', [$l->id]) }}">
                            <i class="fas fa-home" style="blue"></i>
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
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>

    <a title="Imprimir Crachás em Massa" href="{{ route('crachas') }}">
        <i class="fas fa-print"></i> Impressão de Crachás
    </a>
</div>

<script type="text/javascript">
    
</script>
@endsection