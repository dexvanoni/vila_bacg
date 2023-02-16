@extends('layouts.app')

@section('content')
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
    <table id="listas" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nome Completo</th>
                <th>Email(login)</th>
                <th>Local</th>
                <th>Contatos</th>
                <th>Perfil</th>
                <th>CPF</th>
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
                    <td>{{$l->cpf}}</td>
                    <td>
                        <a title="Ver Usuário" href="{{ route('usuarios.show', [$l->id]) }}">
                            <i class="fas fa-home" style="blue"></i>
                        </a>
                        <a title="Excluir Usuário" href="{{ route('usuarios.delete', [$l->id]) }}">
                                <i class="fas fa-trash-alt" style="color: red; margin-left: 10PX;"></i>
                        </a>
                        <!--<a title="QR-Code" href="{{ route('qrcode_organico', [$l->id]) }}">
                                <i class="fas fa-qrcode" style="color: green; margin-left: 10PX;"></i>
                        </a>-->
                        <a title="QR-Code" href="#" data-toggle="modal" data-target="#QRView-<?php echo $l->id; ?>">
                                <i class="fas fa-qrcode" style="color: green; margin-left: 1rem;"></i>
                            </a>

                    </td>
                </tr>
                <!--MODAL QUE EXIBE O QR-CODE-->
                                <div class="modal fade" id="QRView-<?=$l->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>Usuário nº {{$l->name}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         {!! QrCode::size(300)->generate($l->id) !!}
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--FIM DO MODAL-->
            @endforeach
        </tbody>
    </table>

    
</div>
@endsection
