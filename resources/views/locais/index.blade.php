@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Locais e Edificações</h2>
        </div>
    </div>
    <hr>
    <table id="listas" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Local</th>
                <th>Tipo</th>
                <th>Responsável</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locais as $l)
                <tr>
                    <td>{{$l->local}}</td>
                    <td>{{$l->tipo}}</td>
                    <td>
                        {{$l->responsavel}}
                        @php
                            $contato = DB::table('users')->where('name', $l->responsavel)->first();
                        @endphp
                        @isset($contato->telefone)
                            - Contatos: {{$contato->telefone}} / {{$contato->ramal}}
                        @endisset
                    </td>
                    <td>{{$l->status}}</td>
                    <td>
                        <a title="Ver Edificação" href="{{ route('locais.show', [$l->id]) }}">
                            <i class="fas fa-home" style="blue"></i>
                        </a>
                        <a title="Excluir Edificação" href="{{ route('locais.delete', [$l->id]) }}">
                                <i class="fas fa-trash-alt" style="color: red; margin-left: 10PX;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
