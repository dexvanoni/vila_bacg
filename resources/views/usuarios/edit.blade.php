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
                    @if (session('update'))
                        <div class="alert alert-success" role="alert">
                            {{ session('update') }}
                        </div>
                    @endif
                <form method="POST" action="{{ route('usuarios.update', ['id' => $usuario->id])}}" enctype="multipart/form-data" id="update-form">
                        @csrf
                        @method('PUT')
                <div class="mt-4" style="margin: 20px; height: auto;">
                    <div class="row bordered-row">
                      <!-- Coluna da esquerda com duas imagens -->
                      <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                         <div class="d-flex flex-column justify-content-between" >
                            Foto de rosto:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo" src="{{ asset('storage/usuarios/'.$usuario->arquivo) }}" alt="Imagem de perfil"  class="img-fluid" style="max-width: 80%;">
                            </div>
                            <div class="row">
                              Atualizar foto
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01" name="arquivo" accept="image/png, image/jpeg" onchange="previewImage(event, 'confirm-image-arquivo')" onchange="displayFileName()" placeholder="Clique aqui">
                                  <label class="custom-file-label" for="arquivo"></label>
                              </div>
                            </div>
                            <hr>
                            CNH ou Identidade:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo-cnh" src="{{ asset('storage/usuarios_cnh/'.$usuario->arquivo_cnh) }}" alt="Imagem da CNH ou Identidade" class="img-fluid" style="max-width: 80%;">
                            </div>
                            <div class="row">
                              Atualizar CNH
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="arquivo_cnh" aria-describedby="inputGroupFileAddon01" name="arquivo_cnh" accept="image/png, image/jpeg" onchange="previewImage(event, 'confirm-image-arquivo-cnh')" onchange="displayFileName_cnh()">
                                  <label class="custom-file-label" for="arquivo_cnh"></label>
                              </div>
                            </div>
                         </div>
                    </div>
                    <!-- Coluna da direita com mais 12 linhas -->
                    <div class="col-8 bordered-row">
                        <!-- Você pode adicionar qualquer conteúdo aqui -->
                        <div class="row">
                          <div class="col">
                              <p><strong>Nome:</strong> <span id="confirm-name"><input class="form-control" id="name" name="name" value="{{ $usuario->name }}" required></span></p>
                          </div>
                          <div class="col">
                              <p><strong>E-mail:</strong> <span id="confirm-email"><input class="form-control" type="email" id="email" name="email" value="{{ $usuario->email }}" required></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>RG:</strong> <span id="confirm-rg"><input type="text" class="form-control" id="rg" name="rg" value="{{$usuario->rg}}" placeholder="Somente números" required></span></p>
                          </div>
                          <div class="col">
                              <p><strong>CPF:</strong> <span id="confirm-cpf"><input class="form-control" id="cpf" name="cpf" value="{{ $usuario->cpf }}" maxlength="11" onfocusout="validarCPF(cpf)" placeholder="Somente números" required></span></p>
                          </div>
                          
                      </div>
                      <div class="row">
                        <div class="col">
                              <p><strong>Telefone:</strong> <span id="confirm-telefone"><input id="telefone" type="tel"  maxlength="15" onkeyup="handlePhone(event)" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ $usuario->telefone }}" required></span></p>
                          </div>
                          <div class="col">
                              <p><strong>Data de Nascimento:</strong> <span id="confirm-nascimento"><input id="nascimento" type="date" class="form-control" name="nascimento" value="{{date('Y-m-d', strtotime($usuario->nascimento))}}" required></span></p>
                          </div>
                          @if (Auth::user()->autorizacao == 'ad')
                          <div class="col">
                              <p><strong>Status do Usuário:</strong>                              
                                <select class="form-control" id="status" name="status" required>
                                  <option value="1" {{ $usuario->status == 1 ? 'selected' : '' }}>ATIVO</option>
                                  <option value="0" {{ $usuario->status == 0 ? 'selected' : '' }}>INATIVO</option>
                                  <option value="2" {{ $usuario->status == 2 ? 'selected' : '' }}>DESABILITADO</option>
                              </select></p>
                          </div>
                          @endif
                      </div>
                      <div class="row">
                        <div class="col">
                              <p><strong>Endereço (Local de acesso):</strong><span id="confirm-name">
                                  <select class="form-control" id="local" name="local" required>
                                      <option>Selecione...</option>
                                      @foreach ($locais as $l)
                                          <option value="{{ $l->local }}" {{ $usuario->local == $l->local ? 'selected' : '' }}>
                                              {{ $l->local }}
                                          </option>
                                      @endforeach
                                  </select></span></p>
                          </div>
                      </div>
                      <hr>
                      <div id="condutores">
                          <div class="row">
                              <div class="col">
                                <p><strong>Condutor de Veículo?</strong><span id="confirm-condutor">
                                <select class="form-control" name="condutor" required>
                                  <option value="sim" {{ $usuario->condutor == 'sim' ? 'selected' : '' }}>SIM</option>
                                  <option value="nao" {{ $usuario->condutor == 'nao' ? 'selected' : '' }}>NÃO</option>
                              </select></span></p>
                              </div>
                              <div class="col">
                                <p><strong>N° CNH:</strong> <span id="confirm-num_cnh"><input type="text" class="form-control" id="num_cnh" name="num_cnh" value="{{$usuario->num_cnh}}" placeholder="Somente números" required></span></p>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Categoria CNH:</strong> <span id="confirm-categoria_cnh"><select class="form-control" id="categoria_cnh" name="categoria_cnh">
                                    <option value="A" {{ $usuario->categoria_cnh == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ $usuario->categoria_cnh == 'B'? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ $usuario->categoria_cnh == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="AC" {{ $usuario->categoria_cnh == 'AC' ? 'selected' : '' }}>AC</option>
                                    <option value="AD" {{ $usuario->categoria_cnh == 'AD' ? 'selected' : '' }}>AD</option>
                                    <option value="AE" {{ $usuario->categoria_cnh == 'AE' ? 'selected' : '' }}>AE</option>
                                </select></span></p>
                              </div>
                              <div class="col">
                                <p><strong>Validade CNH:</strong> <span id="confirm-validade_cnh"><input id="validade_cnh" type="date" class="form-control" name="validade_cnh" value="{{date('Y-m-d', strtotime($usuario->validade_cnh))}}" required></span></p>
                          </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col">
                          <h3 style="color: red;">IMPORTANTE: Edite os dados com atenção! O CPF é o método de login do usuário no SisVila. Alterar somente em casos excepcionais!</h3>
                        </div>
                      </div>
                       <div class="row justify-content-center align-items-center">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-primary" onclick="confirmUpdate(event)">
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
<script>
function previewImage(event, imgElementId) {
    const input = event.target;
    const reader = new FileReader();
    
    reader.onload = function(){
        const output = document.getElementById(imgElementId);
        output.src = reader.result;
    };

    if(input.files && input.files[0]){
        reader.readAsDataURL(input.files[0]);
    }
}

function confirmUpdate(event) {
    event.preventDefault(); // Impede a submissão imediata do formulário
    if (confirm('Você tem certeza que deseja atualizar as informações?')) {
        document.getElementById('update-form').submit(); // Submete o formulário se o usuário confirmar
    }
}
</script> 
@endsection