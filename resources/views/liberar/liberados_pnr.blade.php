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
            <h2>Convidados e Visitantes liberados no meu PNR</h2>
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
                <th>Nome</th>
                <th>Documento</th>
                <th>Data do cadastro</th>
                <th>Data e hora da autorização de movimentação</th>
                <th>Quem liberou</th>
            </tr>
        </thead>
        <tbody>
            @foreach($liberados as $l)
                <tr>
                    <td>{{$l->nome_completo}}</td>
                    <td>{{$l->doc}}</td>
                    <td>{{date('d/m/Y', strtotime($l->created_at))}}</td>
                    <td>{{date('d/m/Y', strtotime($l->dt_entrada))}} {{$l->hr_entrada}}</td>
                    <td>{{$l->liberador}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
