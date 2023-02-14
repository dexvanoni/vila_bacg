@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila.png" width="100px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>LISTAS DE INGRESSO PARA EVENTOS</h2>
        </div>
    </div>
    <hr>
    <table id="listas" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Portão</th>
                <th>Perm./Dep.</th>
                <th>Local</th>
                <th>Dt/H Evento</th>
                <th>Convidados</th>
                <th>Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listas as $l)
                <tr>
                    <td>
                        @if($l->portao == 'PVO - Vila dos Oficiais (Duque de Caxias)')
                            PVO
                        @elseif($l->portao == 'PVSS - Vila dos Suboficiais e Sargentos (Taveirópolis)')
                            PVSS
                        @elseif($l->portao == 'Portão Principal - Duque de Caxias')
                            PP
                        @else
                            PI
                        @endif
                    </td>
                    <td>{{$l->dono}}</td>
                    <td>{{$l->local_evento}}</td>
                    <td>{{date('d/m/Y', strtotime($l->dt_evento))}} às {{$l->hr_evento}}</td>
                    <td>{{$l->qtn}}</td>
                    <td>{{date('d/m/Y H:i:s', strtotime($l->created_at))}}
                        @php
                            $cria = date('Y-m-d', strtotime($l->created_at));
                            $hoje = date('Y-m-d', strtotime(Carbon\Carbon::now()));
                            $ontem = date('Y-m-d', strtotime(Carbon\Carbon::yesterday()));
                            //echo $cria.' - '.$hoje.' - '.$ontem;
                        @endphp
                        @if($cria == $hoje || $cria == $ontem)
                            <span class="badge badge-pill badge-warning">New</span>
                        @endif

                    </td>
                    <td>
                        <a title="Baixar arquivo" href="{{ route('listas.download', ['lista' => $l->id]) }}">
                            <i class="fas fa-download" style="blue"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
