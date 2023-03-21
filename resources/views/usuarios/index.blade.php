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
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $l)
                <tr>
                    <td style="color: 
                        @if($l->status == 0)
                            red
                        @endif
                            ">
                            {{$l->name}}</td>
                    <td>{{$l->cpf}}</td>
                    <td>
                        <a title="Ver Usuário" href="{{ route('usuarios.show', [$l->id]) }}">
                            <i class="fas fa-home" style="blue"></i>
                        </a>
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</div>
@endsection