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
foreach(explode(',',  $alunos_resp->autorizacao) as $info){
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
      <h5>Edição de cadastro de Responsáveis por Alunos</h5>
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
  <form method="POST" action="{{ route('aluno_resp.update', ['id' => $alunos_resp->id])}}" enctype="multipart/form-data" id="update-form">
    @csrf
    @method('PUT')
    <div class="mt-4" style="margin: 20px; height: auto;">
      <div class="row bordered-row">
         <!-- Coluna da esquerda com duas imagens -->
                      <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                         <div class="d-flex flex-column justify-content-between" >
                            Foto de rosto:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo" src="{{ asset('storage/alunos/'.$alunos_resp->arquivo_resp) }}" alt="Imagem de perfil"  class="img-fluid" style="max-width: 80%;">
                            </div>
                            <div class="row">
                              Atualizar foto
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="arquivo_resp" aria-describedby="inputGroupFileAddon01" name="arquivo_resp" accept="image/png, image/jpeg" onchange="previewImage(event, 'confirm-image-arquivo')" onchange="displayFileName()" placeholder="Clique aqui">
                                  <label class="custom-file-label" for="arquivo_resp"></label>
                              </div>
                            </div>
                            <hr>
                            CNH ou Identidade:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo-cnh" src="{{ asset('storage/usuarios_cnh/'.$alunos_resp->arquivo_cnh_resp) }}" alt="Imagem da CNH ou Identidade" class="img-fluid" style="max-width: 80%;">
                            </div>
                            <div class="row">
                              Atualizar CNH
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="arquivo_cnh_resp" aria-describedby="inputGroupFileAddon01" name="arquivo_cnh_resp" accept="image/png, image/jpeg" onchange="previewImage(event, 'confirm-image-arquivo-cnh')" onchange="displayFileName_cnh()">
                                  <label class="custom-file-label" for="arquivo_cnh_resp"></label>
                              </div>
                            </div>
                         </div>
                    </div>
      <!-- Coluna da direita com mais 12 linhas -->
      <div class="col-8 bordered-row">
        <!-- Você pode adicionar qualquer conteúdo aqui -->
        <div class="row">
          <div class="col">
            <p><strong>Nome:</strong> <span id="confirm-name"><input class="form-control" id="nome_resp" name="nome_resp" value="{{ $alunos_resp->nome_resp }}" required></span></p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p><strong>RG:</strong> <span id="confirm-rg"><input type="text" class="form-control" id="rg" name="rg_resp" value="{{$alunos_resp->rg_resp}}" placeholder="Somente números" required></span></p>
          </div>
          <div class="col">
            <p><strong>CPF:</strong> <span id="confirm-cpf"><input class="form-control" id="cpf" name="cpf_resp" value="{{ $alunos_resp->cpf_resp }}" maxlength="11" onfocusout="validarCPF(cpf_resp)" placeholder="Somente números" required></span></p>
          </div>

        </div>
        <div class="row">
          <div class="col">
            <p><strong>Status do Usuário:</strong>                              
              <select class="form-control" id="status" name="status_aluno" required>
                <option value="1" {{ $alunos_resp->status_aluno == 1 ? 'selected' : '' }}>ATIVO</option>
                <option value="0" {{ $alunos_resp->status_aluno == 0 ? 'selected' : '' }}>INATIVO</option>
                <option value="2" {{ $alunos_resp->status_aluno == 2 ? 'selected' : '' }}>DESABILITADO</option>
              </select></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-3">
              <label for="cep_resp">CEP</label>
              <input class="form-control" id="cep_resp" name="cep_resp" value="{{ $alunos_resp->cep_resp }}" required>
            </div>
            <div class="col-7">
              <label for="rua_resp">Logradouro</label>
              <input class="form-control" id="rua_resp" name="rua_resp" value="{{ $alunos_resp->rua_resp }}" readonly required>
            </div>
            <div class="col-2">
              <label for="num_casa_resp">Nº</label>
              <input class="form-control" id="num_casa_resp" name="num_casa_resp" value="{{ $alunos_resp->num_casa_resp }}" required>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <label for="bairro_resp">Bairro</label>
              <input class="form-control" id="bairro_resp" name="bairro_resp" value="{{ $alunos_resp->bairro_resp }}" readonly required>
            </div>
            <div class="col-6">
              <label for="cidade_resp">Cidade</label>
              <input class="form-control" id="cidade_resp" name="cidade_resp" value="{{ $alunos_resp->cidade_resp }}" readonly required>
            </div>
          </div>
            <hr>
            @if($alunos_resp->tipo_aluno == 'RESPONSÁVEL POR ALUNO')
            <div id="condutores">
                          <div class="row">
                              <div class="col">
                                <p><strong>N° CNH:</strong> <span id="confirm-num_cnh_resp"><input type="text" class="form-control" id="num_cnh_resp" name="num_cnh_resp" value="{{$alunos_resp->num_cnh_resp}}" placeholder="Somente números" required></span></p>
                            </div>
                            <div class="col">
                                  <p><strong>Categoria CNH:</strong> <span id="confirm-categoria_cnh_resp"><select class="form-control" id="categoria_cnh_resp" name="categoria_cnh_resp">
                                    <option value="A" {{ $alunos_resp->categoria_cnh_resp == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ $alunos_resp->categoria_cnh_resp == 'B'? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ $alunos_resp->categoria_cnh_resp == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="AC" {{ $alunos_resp->categoria_cnh_resp == 'AC' ? 'selected' : '' }}>AC</option>
                                    <option value="AD" {{ $alunos_resp->categoria_cnh_resp == 'AD' ? 'selected' : '' }}>AD</option>
                                    <option value="AE" {{ $alunos_resp->categoria_cnh_resp == 'AE' ? 'selected' : '' }}>AE</option>
                                </select></span></p>
                              </div>
                              <div class="col">
                                <p><strong>Validade CNH:</strong> <span id="confirm-validade_cnh_resp"><input id="validade_cnh_resp" type="date" class="form-control" name="validade_cnh_resp_resp" value="{{date('Y-m-d', strtotime($alunos_resp->validade_cnh_resp))}}" required></span></p>
                          </div>
                          </div>
                      </div>
                      @endif
          <div class="row">
            <div class="col">
              <h3 style="color: red;">IMPORTANTE: Edite os dados com atenção!</h3>
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