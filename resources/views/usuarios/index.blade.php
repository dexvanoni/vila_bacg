@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila.png" width="100px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Usuários do SisVILA</h2>
        </div>
    </div>
    <hr>
    <table id="listas" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nome Completo</th>
                <th>Email(login)</th>
                <th>Local</th>
                <th>Contatos</th>
                <th>Perfil</th>
                <th>RG / CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $l)
                <tr>
                    <td>{{$l->name}}</td>
                    <td>{{$l->email}}</td>
                    <td>{{$l->local}}</td>
                    <td>{{$l->telefone}} / {{$l->ramal}}</td>
                    <td>{{$l->autorizacao}}</td>
                    <td>{{$l->rg}} / {{$l->cpf}}</td>
                    <td>
                        <a title="Ver Usuário" href="{{ route('usuarios.show', [$l->id]) }}">
                            <i class="fas fa-home" style="blue"></i>
                        </a>
                        <a title="Excluir Usuário" href="{{ route('usuarios.delete', [$l->id]) }}">
                                <i class="fas fa-trash-alt" style="color: red; margin-left: 10PX;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
