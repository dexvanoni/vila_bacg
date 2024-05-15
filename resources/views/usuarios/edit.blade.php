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
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="80px">        
        </div>
        <div class="col-md-10">
            <h5>Edição de cadastro de Usuário</h5>
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
                <form method="POST" action="{{ route('usuarios.update', ['id' => $usuario->id])}}">
                        @csrf
                        @method('PUT')
                <div class="mt-4" style="margin: 20px; height: auto;">
                    <div class="row bordered-row">
                      <!-- Coluna da esquerda com duas imagens -->
                      <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                         <div class="d-flex flex-column justify-content-between" >
                            Foto de rosto:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo" src="{{ asset('storage/usuarios/'.$usuario->arquivo) }}" alt="Imagem de perfil"  class="img-fluid" style="max-width: 80%;">
                            </div>
                            CNH ou Identidade:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo-cnh" src="{{ asset('storage/usuarios_cnh/'.$usuario->arquivo_cnh) }}" alt="Imagem da CNH ou Identidade" class="img-fluid" style="max-width: 80%;">
                            </div>
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
                              <p><strong>Endereço:</strong><span id="confirm-name">{{$usuario->local}}</span></p>
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
                      <hr>
                       <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-primary">
                                                Atualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                  </div>
              </div>
          </div>
      </form>
</div>  

@endsection