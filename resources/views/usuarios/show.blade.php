@extends('layouts.app')

@section('cad_morador')
/* Borda fina e cinza com cantos arredondados para imagens do grid específico */
    .bordered-image {
      border: 1px solid #cccccc; /* Borda cinza */
      border-radius: 10px; /* Cantos arredondados */
    }

    /* Borda fina e cinza com cantos arredondados para linhas do grid específico */
    .bordered-row {
      border: 1px solid #cccccc; /* Borda cinza */
      border-radius: 10px; /* Cantos arredondados */
      padding: 10px; /* Adicionar espaçamento interno */
    }

.img-container {
    position: relative;
    margin-bottom: 20px; /* Adicione margem entre as imagens */
}

img {
    width: 100%;
    max-width: 600px;
}

.img-zoom-result {
    border: 1px solid #d4d4d4;
    width: 300px;
    height: 300px;
    position: absolute;
    top: 0;
    left: 300px;
    display: none;
    overflow: hidden;
    background-repeat: no-repeat;
    z-index: 1000;
}

.img-zoom-lens {
    position: absolute;
    width: 100px;
    height: 100px;
    cursor: none;
}
@endsection

@php
 $perfis = collect([]);
                      foreach(explode(',',  $usuario->autorizacao) as $info){
                        if ($info == 'mo') {
                  $perfis->push('Morador');
                } elseif ($info == 'so') {
                  $perfis->push('Sócio');
                } elseif ($info == 'ef') {
                  $perfis->push('Efetivo BACG');
                } elseif ($info == 'fe') {
                  $perfis->push('Funcionário da Escola');
                } elseif ($info == 'ra') {
                  $perfis->push('Responsável por Aluno');
                } elseif ($info == 'po') {
                  $perfis->push('Portaria');
                } elseif ($info == 'al') {
                  $perfis->push('Aluno');
                } elseif ($info == 'ad') {
                  $perfis->push('Administrador');
                  } elseif ($info == 'al') {
                  $perfis->push('Aluno');
                }
                        $perfis->all();
                      }
@endphp

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-10">
            <h5>Controle de Usuário do SisVila</h5>
        </div>
    </div>
    <hr>
    
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
                    @if($errors->any())
                      <div class="alert alert-danger" role="alert">
                              @foreach($errors->all() as $error)
                                      {{ $error }}
                              @endforeach
                      </div>
                    @endif
                <div class="mt-4" style="margin: 20px; height: auto; width: 80%;">
                    <strong style="color: red;">Passe o mouse nas imagens para dar zoom!</strong> 
                    <div class="row bordered-row">
                      <!-- Coluna da esquerda com duas imagens -->
                      <div class="col-4 d-flex flex-column justify-content-center align-items-center">

                         <div class="d-flex flex-column justify-content-between" >
                            Foto de rosto:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="foto" src="{{ asset('storage/usuarios/'.$usuario->arquivo) }}" alt="Sem imagem de perfil"  class="img-fluid" style="max-width: 80%;">
                            </div>
                            <div id="foto_resultado" class="img-zoom-result"></div>
                            CNH ou Identidade:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="cnh" src="{{ asset('storage/usuarios_cnh/'.$usuario->arquivo_cnh) }}" alt="Sem imagem da CNH ou Identidade" class="img-fluid" style="max-width: 60%;">
                            </div>
                            <div id="cnh_resultado" class="img-zoom-result"></div>
                         </div>
                    </div>
                    <!-- Coluna da direita com mais 12 linhas -->
                    <div class="col-8 bordered-row">
                        <!-- Você pode adicionar qualquer conteúdo aqui -->
                        <div class="row">
                          <div class="col">
                              <p><strong>Nome:</strong> <span id="confirm-name">{{$usuario->name}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>E-mail:</strong> <span id="confirm-email">{{$usuario->email}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>RG:</strong> <span id="confirm-rg">{{$usuario->rg}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>CPF:</strong> <span id="confirm-cpf">{{$usuario->cpf}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Telefone:</strong> <span id="confirm-telefone">{{$usuario->telefone}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Data de Nascimento:</strong> <span id="confirm-nascimento">{{date('d/m/Y', strtotime($usuario->nascimento))}}</span></p>
                          </div>
                      </div>
                       <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Endereço:</strong><span id="confirm-name"> {{$usuario->local}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col">
                            <p><strong>Status:</strong><span>@if($usuario->status == 1)
                                    ATIVO
                                @else
                                    INATIVO 
                            @endif</span></p>
                        </div>
                          
                      </div>
                      <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div id="condutores">
                          <div class="row">
                              <div class="col">
                                  <p><strong>É condutor de veículos:</strong> <span id="confirm-condutor">{{$usuario->condutor}}</span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>N° CNH:</strong> <span id="confirm-num_cnh">{{$usuario->num_cnh}}</span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Categoria CNH:</strong> <span id="confirm-categoria_cnh">{{$usuario->categoria_cnh}}</span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Validade CNH:</strong> <span id="confirm-validade_cnh">{{date('d/m/Y', strtotime($usuario->validade_cnh))}}</span></p>
                              </div>
                          </div>
                      </div>
                      
                      @if ($usuario->parecer_sint != null)
                      <hr>
                      <div class="row">
                              <div class="col">
                                  <p><strong>Parecer da SINT:</strong> {{ $usuario->motivo_sint }}</p>
                              </div>
                          </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-danger" title="Excluir Usuário" href="{{ route('usuarios.delete', [$usuario->id]) }}">
                                <i class="fas fa-trash-alt"></i> EXCLUIR
                            </a>
                            <a class="btn btn-secondary" title="Editar cadastro" href="{{ route('usuarios.edit', [$usuario->id]) }}">
                                <i class="fas fa-user-edit"></i> EDITAR
                            </a>
                        <!--<a title="QR-Code" href="{{ route('qrcode_organico', [$usuario->id]) }}">
                                <i class="fas fa-qrcode" style="color: green; margin-left: 10PX;"></i>
                        </a>-->
                        @if($usuario->autorizacao <> 'po')
                            <a title="QR-Code" class="btn btn-success" href="#" data-toggle="modal" data-target="#QRView-<?php echo $usuario->id; ?>">
                                <i class="fas fa-qrcode"></i> QR-CODE
                            </a>
                        @endif
                        @if($usuario->status == 1)
                                <a title="Desabilitar Usuário" class="btn btn-warning" href="{{ route('usuarios.desab', [$usuario->id]) }}">
                                    <i class="fas fa-dizzy"></i> Desabilitar
                                </a>
                                @else
                                <a title="Habilitar Usuário" class="btn btn-info" href="{{ route('usuarios.hab', [$usuario->id]) }}">
                                    <i class="fas fa-smile"></i> Habilitar
                                </a>
                            @endif
                        </div>
                         
                    </div>

                  </div>
              </div>
              @if (Auth::user()->autorizacao == 'ad')
              <div class="row bordered-row">
                <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        Informações via Email ao(a) Sr.(a) {{ $usuario->name }}
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">Digite neste campo sua mensagem</h5>
                             <div class="form-group">
                               <form action="{{ route('usuario.sendEmail', $usuario->id) }}" method="POST">
                                  @csrf
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="O email será encaminhado a {{ $usuario->email }}"></textarea><br>
                                <button type="submit" class="btn btn-warning"> <i class="fas fa-mail-bulk"></i> Enviar Email</button>
                              </form>
                              </div>
                              
                      </div>
                    </div>
                </div>
              </div>
              @endif
              <!--MODAL QUE EXIBE O QR-CODE-->
                                <div class="modal fade" id="QRView-<?=$usuario->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>Usuário: {{$usuario->name}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         {!! QrCode::size(300)->generate($usuario->cpf) !!}
                                         
                                      </div>
                                      <div class="modal-footer">

                                        <a title="QR-Code" href="{{ route('qrcode_organico', [$usuario->cpf]) }}">
                                           Imprimir
                                        </a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--FIM DO MODAL-->
          </div>
</div>  

<script>
</script>

@endsection
