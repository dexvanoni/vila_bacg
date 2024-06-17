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
      <h5>Edição de cadastro de Aluno</h5>
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
          <div class="h-80 d-flex align-items-center justify-content-center bordered-row">
            <img id="confirm-image-arquivo" src="{{ asset('storage/alunos/'.$alunos_resp->arquivo_aluno) }}" alt="Imagem de perfil"  class="img-fluid" style="max-width: 90%;">
          </div>
          <div class="row">
            Atualizar foto
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01" name="arquivo_aluno" accept="image/png, image/jpeg" onchange="previewImage(event, 'confirm-image-arquivo')" onchange="displayFileName()" placeholder="Clique aqui">
              <label class="custom-file-label" for="arquivo"></label>
            </div>
          </div>
        </div>
      </div>
      <!-- Coluna da direita com mais 12 linhas -->
      <div class="col-8 bordered-row">
        <!-- Você pode adicionar qualquer conteúdo aqui -->
        <div class="row">
          <div class="col">
            <p><strong>Nome:</strong> <span id="confirm-name"><input class="form-control" id="name" name="nome_aluno" value="{{ $alunos_resp->nome_aluno }}" required></span></p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p><strong>RG:</strong> <span id="confirm-rg"><input type="text" class="form-control" id="rg" name="rg_aluno" value="{{$alunos_resp->rg_aluno}}" placeholder="Somente números" required></span></p>
          </div>
          <div class="col">
            <p><strong>CPF:</strong> <span id="confirm-cpf"><input class="form-control" id="cpf" name="cpf_aluno" value="{{ $alunos_resp->cpf_aluno }}" maxlength="11" onfocusout="validarCPF(cpf_aluno)" placeholder="Somente números" required></span></p>
          </div>

        </div>
        <div class="row">
          <div class="col">
            <p><strong>Data de Nascimento:</strong> <span id="confirm-nascimento"><input id="dt_nascimento_aluno" type="date" class="form-control" name="dt_nascimento_aluno" value="{{date('Y-m-d', strtotime($alunos_resp->dt_nascimento_aluno))}}" required></span></p>
          </div>
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
              <label for="cep_aluno">CEP</label>
              <input class="form-control" id="cep_aluno" name="cep_aluno" value="{{ $alunos_resp->cep_aluno }}" required>
            </div>
            <div class="col-7">
              <label for="rua_aluno">Logradouro</label>
              <input class="form-control" id="rua_aluno" name="rua_aluno" value="{{ $alunos_resp->rua_aluno }}" readonly required>
            </div>
            <div class="col-2">
              <label for="num_casa_aluno">Nº</label>
              <input class="form-control" id="num_casa_aluno" name="num_casa_aluno" value="{{ $alunos_resp->num_casa_aluno }}" required>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <label for="bairro_aluno">Bairro</label>
              <input class="form-control" id="bairro_aluno" name="bairro_aluno" value="{{ $alunos_resp->bairro_aluno }}" readonly required>
            </div>
            <div class="col-6">
              <label for="cidade_aluno">Cidade</label>
              <input class="form-control" id="cidade_aluno" name="cidade_aluno" value="{{ $alunos_resp->cidade_aluno }}" readonly required>
            </div>
          </div>
          <hr>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="local_aluno">Instituição de ensino</label>
                        <select class="form-control" id="local_aluno" name="local_aluno" required>
                                <option value="EMEI Maria Josefina" {{ $alunos_resp->local_aluno == 'EMEI Maria Josefina' ? 'selected' : '' }}>EMEI Maria Josefina</option>
                                <option value="ESCOLA Y-JUCA PIRAMA" {{ $alunos_resp->local_aluno == 'ESCOLA Y-JUCA PIRAMA' ? 'selected' : '' }}>ESCOLA Y-JUCA PIRAMA</option>
                        </select>
                    </div> 
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="serie_aluno">Série/grupo</label>
                          <select class="form-control" id="serie_aluno" name="serie_aluno" required>
                            <option>Séries da Escola</option>
                            <option value="1° Ano A" {{ $alunos_resp->serie_aluno == '1° Ano A' ? 'selected' : '' }}>1° Ano A</option>
                            <option value="1° Ano B" {{ $alunos_resp->serie_aluno == '1° Ano B' ? 'selected' : '' }}>1° Ano B</option>
                            <option value="2° Ano A" {{ $alunos_resp->serie_aluno == '2° Ano A' ? 'selected' : '' }}>2° Ano A</option>
                            <option value="2° Ano B" {{ $alunos_resp->serie_aluno == '2° Ano B' ? 'selected' : '' }}>2° Ano B</option>
                            <option value="3° Ano A" {{ $alunos_resp->serie_aluno == '3° Ano A' ? 'selected' : '' }}>3° Ano A</option>
                            <option value="3° Ano B" {{ $alunos_resp->serie_aluno == '3° Ano B' ? 'selected' : '' }}>3° Ano B</option>
                            <option value="4° Ano A" {{ $alunos_resp->serie_aluno == '4° Ano A' ? 'selected' : '' }}>4° Ano A</option>
                            <option value="4° Ano B" {{ $alunos_resp->serie_aluno == '4° Ano B' ? 'selected' : '' }}>4° Ano B</option>
                            <option value="5° Ano A" {{ $alunos_resp->serie_aluno == '5° Ano A' ? 'selected' : '' }}>5° Ano A</option>
                            <option value="5° Ano B" {{ $alunos_resp->serie_aluno == '5° Ano B' ? 'selected' : '' }}>5° Ano B</option>
                            <option value="6° Ano A" {{ $alunos_resp->serie_aluno == '6° Ano A' ? 'selected' : '' }}>6° Ano A</option>
                            <option value="6° Ano B" {{ $alunos_resp->serie_aluno == '6° Ano B' ? 'selected' : '' }}>6° Ano B</option>
                            <option value="7° Ano A" {{ $alunos_resp->serie_aluno == '7° Ano A' ? 'selected' : '' }}>7° Ano A</option>
                            <option value="7° Ano B" {{ $alunos_resp->serie_aluno == '7° Ano B' ? 'selected' : '' }}>7° Ano B</option>
                            <option value="8° Ano A" {{ $alunos_resp->serie_aluno == '8° Ano A' ? 'selected' : '' }}>8° Ano A</option>
                            <option value="8° Ano B" {{ $alunos_resp->serie_aluno == '8° Ano B' ? 'selected' : '' }}>8° Ano B</option>
                            <option value="9° Ano A" {{ $alunos_resp->serie_aluno == '9° Ano A' ? 'selected' : '' }}>9° Ano A</option>
                            <option value="9° Ano B" {{ $alunos_resp->serie_aluno == '9° Ano B' ? 'selected' : '' }}>9° Ano B</option>
                            <option>-----------------------------------------------------------</option>
                            <option>Grupos da EMEI</option>
                             <option value="Grupo 2" {{ $alunos_resp->serie_aluno == 'Grupo 2' ? 'selected' : '' }}>Grupo 2</option>
                             <option value="Grupo 3" {{ $alunos_resp->serie_aluno == 'Grupo 3' ? 'selected' : '' }}>Grupo 3</option>
                             <option value="Grupo 4" {{ $alunos_resp->serie_aluno == 'Grupo 4' ? 'selected' : '' }}>Grupo 4</option>
                             <option value="Grupo 5" {{ $alunos_resp->serie_aluno == 'Grupo 5' ? 'selected' : '' }}>Grupo 5</option>
                        }
                        }
                        </select>
                    </div> 
                </div>
            </div>
            <hr>
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