@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-12">
            <h2>Arquivos da ACVBA</h2>
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
            <h4>Ação para vários registros</h4>
        </div>
        <div class="row">
                <div class="col-2 align-self-start">
                    <button id="deleteSelected" title="APAGAR TODOS SELECIONADOS" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </div>
                <div class="col-7 align-self-center"></div>
                <div class="col-3 align-self-end">
                    <a title="Adicionar Documento" class="btn btn-success" href="{{ route('docs.create') }}">
                        <i class="fas fa-file-upload"> Adicionar arquivo</i>
                    </a>
                </div>
        </div>
        <hr>
    @endif

    
    <table id="lista_alunos" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                @if (Auth::user()->autorizacao == 'ad')
                    <th><input type="checkbox" id="selectAll"></th>
                @endif
                <th>Documento</th>
                <th>Observações</th>
                <th>Data Upload</th>
                @if (Auth::user()->autorizacao == 'ad')
                    <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($docs as $l)
                    <tr>
                        @if (Auth::user()->autorizacao == 'ad')
                            <td><input type="checkbox" name="selected[]" value="{{ $l->id }}"></td>
                        @endif
                        <td>{{$l->doc}}</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{$l->obs}}</td>
                        <td>{{\Carbon\Carbon::parse($l->dt)->format('d/m/Y')}}</td>
                        <td>
                            @if (Auth::user()->autorizacao == 'ad')
                            <a title="Deletar Documento" style="color: darkred;" href="{{ route('docs.delete', [$l->id]) }}">
                                <i class="fas fa-trash-alt btn-delete" style="blue"></i>
                            </a>
                            @endif
                            <a title="Baixar Documento" style="color: blue;" href="{{ route('docs.download', [$l->id]) }}">
                                <i class="fas fa-download"></i>
                            </a>

                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection