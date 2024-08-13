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
    width: 400px;
    height: 400px;
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

.btn-custom-size {
    padding: 10px 20px;
    font-size: 16px;
    width: 170px; /* largura fixa */
    text-align: center; /* centralizar texto */
}

@media (max-width: 768px) {
    .btn-custom-size {
        padding: 8px 16px;
        font-size: 14px;
        width: 150px; /* largura ajustada para telas menores */
    }
}

@media (max-width: 576px) {
    .btn-custom-size {
        padding: 6px 12px;
        font-size: 12px;
        width: 100px; /* largura ajustada para telas ainda menores */
    }
}
@endsection

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-10">
            <h5>Controle de Responsáveis por Alunos do SisVila</h5>
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
                                <img id="foto" src="{{ asset('storage/alunos/'.$alunos_resp->arquivo_resp) }}" alt="Sem imagem de perfil"  class="img-fluid" style="max-width: 80%;">
                            </div>
                            <div id="foto_resultado" class="img-zoom-result"></div>
                            CNH ou Identidade:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="cnh" src="{{ asset('storage/usuarios_cnh/'.$alunos_resp->arquivo_cnh_resp) }}" alt="Sem imagem da CNH ou Identidade" class="img-fluid" style="max-width: 60%;">
                            </div>
                            <div id="cnh_resultado" class="img-zoom-result"></div>
                         </div>
                    </div>
                    <!-- Coluna da direita com mais 12 linhas -->
                    <div class="col-8 bordered-row">
                        <!-- Você pode adicionar qualquer conteúdo aqui -->
                        <div class="row">
                          <div class="col">
                              <p><strong>Nome:</strong> <span id="confirm-name">{{$alunos_resp->nome_resp}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>RG:</strong> <span id="confirm-rg">{{$alunos_resp->rg_resp}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>CPF:</strong> <span id="confirm-cpf">{{$alunos_resp->cpf_resp}}</span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Email:</strong> <span id="confirm-cpf">{{$alunos_resp->email_resp}}</span></p>
                          </div>
                      </div>
                       <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col">
                            <p><strong>Status:</strong><span>@if($alunos_resp->status_aluno == 1)
                                    <strong style="color: green;"> ATIVO</strong> 
                                @else
                                    <strong style="color: red;"> INATIVO</strong>
                            @endif</span></p>
                        </div>
                          
                      </div>
                      <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div class="row">
                              <div class="col">
                                  <p><strong>Endereço:</strong> {{ $alunos_resp->rua_resp }}, {{ $alunos_resp->num_casa_resp }} - {{ $alunos_resp->bairro_resp }} / {{ $alunos_resp->cidade_resp }} - CEP: {{ $alunos_resp->cep_resp }}</p>
                              </div>
                          </div>

                          @if (!is_null($alunos_resp->num_cnh_resp))
                      <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div id="condutores">
                          <div class="row">
                              <div class="col">
                                  <p><strong>N° CNH:</strong> <span id="confirm-num_cnh">{{$alunos_resp->num_cnh_resp}}</span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Categoria CNH:</strong> <span id="confirm-categoria_cnh">{{$alunos_resp->tipo_cnh_resp}}</span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Validade CNH:</strong> <span id="confirm-validade_cnh">{{date('d/m/Y', strtotime($alunos_resp->validade_cnh_resp))}}</span>
                                    @php
                                      $dataValidade = Carbon\Carbon::parse($alunos_resp->validade_cnh_resp);
                                      $validade = $dataValidade->isFuture();
                                    @endphp
                                    @if($validade)
                                       - <strong style="color: green;">CNH Válida!</strong>
                                    @else
                                       - <strong style="color: red;">CNH Vencida!</strong>
                                    @endif
                                  </p>
                              </div>
                          </div>
                      </div>
                      @endif
                      
                      @if ($alunos_resp->parecer_sint != null)
                      <hr>
                      <div class="row">
                              <div class="col">
                                  <p><strong>Parecer da SINT:</strong> {{ $alunos_resp->motivo_sint }}</p>
                              </div>
                          </div>
                    @endif
                    @if ($alunos_resp->parecer_escola != null)
                      <hr>
                      <div class="row">
                              <div class="col">
                                  <p><strong>Parecer da Escola/EMEI:</strong> {{ $alunos_resp->motivo_escola }}</p>
                              </div>
                          </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-danger" title="Excluir Usuário" href="{{ route('aluno_resp.delete', [$alunos_resp->id]) }}">
                                <i class="fas fa-trash-alt"></i> EXCLUIR
                            </a>
                            <a class="btn btn-secondary" title="Editar cadastro" href="{{ route('aluno_resp.edit', [$alunos_resp->id]) }}">
                                <i class="fas fa-user-edit"></i> EDITAR
                            </a>
                        <!--<a title="QR-Code" href="{{ route('qrcode_organico', [$alunos_resp->id]) }}">
                                <i class="fas fa-qrcode" style="color: green; margin-left: 10PX;"></i>
                        </a>-->

                            <a title="QR-Code" class="btn btn-success" href="#" data-toggle="modal" data-target="#QRView-<?php echo $alunos_resp->id; ?>">
                                <i class="fas fa-qrcode"></i> QR-CODE
                            </a>

                        @if($alunos_resp->status_aluno == 1)
                                <a title="Desabilitar Usuário" class="btn btn-warning" href="{{ route('usuarios.desab', [$alunos_resp->id]) }}">
                                    <i class="fas fa-dizzy"></i> Desabilitar
                                </a>
                                @else
                                <a title="Habilitar Usuário" class="btn btn-info" href="{{ route('usuarios.hab', [$alunos_resp->id]) }}">
                                    <i class="fas fa-smile"></i> Habilitar
                                </a>
                            @endif
                        </div>
                         
                    </div>

                  </div>
              </div>

              <!--MODAL QUE EXIBE O QR-CODE-->
                                <div class="modal fade" id="QRView-<?=$alunos_resp->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>Usuário: {{$alunos_resp->name}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         {!! QrCode::size(300)->generate($alunos_resp->cpf_resp) !!}
                                         
                                      </div>
                                      <div class="modal-footer">

                                        <a title="QR-Code" href="{{ route('qrcode_alunos', [$alunos_resp->id]) }}">
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
