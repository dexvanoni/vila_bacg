@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-12">
            <h2>Lista de Convidados</h2>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista do Evento: {{$lista[0]->lista}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <ul>
                        @foreach($lista as $a)
                        <li>
                            <strong>Nome:</strong> {{$a->nome_completo}} - <strong>QR-CODE</strong> 
                                <a title="QR-Code" href="#" data-toggle="modal" data-target="#QRView-<?php echo $a->id; ?>">
                                    <i class="fas fa-qrcode" style="color: green; margin-left: 1rem;"></i>
                                </a>
                        </li>
                        <!--MODAL QUE EXIBE O QR-CODE-->
                                <div class="modal fade" id="QRView-<?=$a->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>Usuário: {{$a->nome_completo}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         {!! QrCode::size(180)->generate($a->id) !!}
                                         
                                      </div>
                                      <div class="modal-footer">

                                        <a title="QR-Code" href="{{ route('qrcode_convidado', [$a->id]) }}">
                                           Imprimir Cartão
                                        </a>
                                        @if($a->contato)
                                            <!--<a title="Enviar QR-Code" href="https://api.whatsapp.com/send?phone=55{{$a->contato}}&text=http://192.168.100.74:8000/qrcode/{{$a->id}}/qrcode/convidado">
                                               Enviar Cartão
                                            </a>-->
                                        @endif
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--FIM DO MODAL-->
                        @endforeach
                    </ul>

                    <!--RELAÇÃO DE LISTAS DO USUÁRIO LOGADO-->

                </div>
            </div>
        </div>
    </div>
</div>  

@endsection
