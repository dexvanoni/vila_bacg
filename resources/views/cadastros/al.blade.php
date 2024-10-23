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
    <div class="container">
        <form id="registration-form-aluno" method="POST" action="{{ route('register_aluno') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="local_aluno">Selecione a instituição de ensino</label>
                        <select class="form-control" id="local_aluno" name="local_aluno" required>
                                <option value="c">Clique aqui...</option>
                                <option value="EMEI Maria Josefina">EMEI Maria Josefina</option>
                                <option value="ESCOLA Y-JUCA PIRAMA">ESCOLA Y-JUCA PIRAMA</option>
                        </select>
                    </div> 
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="serie_aluno">Selecione a série/grupo</label>
                        <select class="form-control" id="serie_aluno" name="serie_aluno" required>
                        </select>
                    </div> 
                </div>
            </div>
            <hr>
            <h4>Dados Pessoais</h4>
            <h6>Faça upload da foto</h6>
            <div class="row">
                <div class="col-md-12" style="margin-bottom: -15px;">
                    <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Foto de rosto</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="arquivo_aluno" aria-describedby="inputGroupFileAddon01" name="arquivo_aluno" accept="image/png, image/jpeg" onchange="displayFileName()" required>
                            <label class="custom-file-label" for="arquivo_aluno"></label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <span id="file-name-span" style="color: green;"></span>
        <div class="row" style="margin-top: 15px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome_aluno">Nome Completo <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Realizar a conferência de letras e acentos!"></i></label>
                    <input class="form-control" id="nome_aluno" name="nome_aluno" value="{{ old('nome_aluno') }}" required autofocus>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="rg_aluno">RG</label>
                    <input type="text" class="form-control" id="rg_aluno" name="rg_aluno" value="{{ old('rg_aluno') }}" placeholder="Somente números">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cpf_aluno">CPF <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Verificação automárica"></i></label>
                    <input class="form-control" id="cpf_aluno" name="cpf_aluno" value="{{ old('cpf_aluno') }}" maxlength="11" onfocusout="validarCPF_aluno(cpf_aluno)" placeholder="Somente números" required>
                    <small id="resultado_aluno"></small>
                    @if ($errors->has('cpf_aluno'))
                        <small class="text-danger">{{ $errors->first('cpf_aluno') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="dt_nascimento_aluno">Data de Nascimento</label>
                    <input id="dt_nascimento_aluno" type="date" class="form-control" name="dt_nascimento_aluno" required>
                </div>
            </div>
                <div class="col-md-3">
                    <label for="cep_aluno">CEP</label>
                    <input class="form-control" id="cep_aluno" name="cep_aluno" required>
                </div>
                <div class="col-md-3">
                    <label for="rua_aluno">Logradouro</label>
                    <input class="form-control" id="rua_aluno" name="rua_aluno" readonly required>
                </div>
                <div class="col-md-3">
                    <label for="num_casa_aluno">Nº</label>
                    <input class="form-control" id="num_casa_aluno" name="num_casa_aluno" required>
                </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="bairro_aluno">Bairro</label>
                <input class="form-control" id="bairro_aluno" name="bairro_aluno" readonly required>
            </div>
            <div class="col-md-6">
                <label for="cidade_aluno">Cidade</label>
                <input class="form-control" id="cidade_aluno" name="cidade_aluno" readonly required>
            </div>
        </div>

<!--INPUTS PREENCHIDOS DE OUTROS FORMULÁRIOS PARA NÃO FICAR NULL NO BANCO-->
<input type="hidden" name="status_aluno" value="0">
<input type="hidden" name="tipo_aluno" value="ALUNO">
<input type="hidden" name="autorizacao_aluno" id="autorizacao_aluno" value="al">

<div class="row" style="margin-top: 30px;">
    <div class="col-12">
        <div class="form-group">
            <button id="envia_aluno" type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal_aluno">
                Enviar
            </button>
        </div>
    </div>
    
</div>
</form>

<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmationModal_aluno" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 730px; width: 600px;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmação de Dados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 style="color: red;">*Vire o celular para ver todos os dados!</h6>
                <div class="mt-4" style="margin: 20px; height: 500px; width: 500px;">
                    <div class="row bordered-row">
                      <!-- Coluna da esquerda com duas imagens -->
                      <div class="col-4 d-flex flex-column justify-content-center align-items-center" style="height: 500px;">
                         <div class="d-flex flex-column" style="height: 100%;">
                            Foto de rosto:
                            <div class="h-80 bordered-row">
                                <img id="confirm-image-arquivo-aluno" src="" alt="Imagem de perfil"  class="img-fluid" >
                            </div>
                         </div>
                    </div>
                    <!-- Coluna da direita com mais 12 linhas -->
                    <div class="col-8 bordered-row" style="height: 500px;">
                        <!-- Você pode adicionar qualquer conteúdo aqui -->
                        <div class="row">
                          <div class="col">
                              <p><strong>Nome:</strong> <span id="confirm-nome_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>RG:</strong> <span id="confirm-rg_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>CPF:</strong> <span id="confirm-cpf_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Data de Nascimento:</strong> <span id="confirm-dt_nascimento_aluno"></span></p>
                          </div>
                      </div>
                       <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Instituição:</strong> <span id="confirm-local_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Série/Grupo:</strong> <span id="confirm-serie_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>CEP:</strong> <span id="confirm-cep_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Logradouro:</strong> <span id="confirm-rua_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>N°:</strong> <span id="confirm-num_casa_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Bairro:</strong> <span id="confirm-bairro_aluno"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Cidade:</strong> <span id="confirm-cidade_aluno"></span></p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
        <button type="button" class="btn btn-primary" id="confirm-submit">Confirmar</button>
    </div>
</div>
</div>

</div>  
</div>
<script>

    //---------------------------------------------------------------------------------------------------
        // O JS que faz a captura dos dados dos inputs e aparece no modal está no arquivo views/layouts/app.blade.php
        // Ele mostra os dados preenchidos e confirma o envio dos dados ou não.
    //---------------------------------------------------------------------------------------------------

    // traz o nome do arquivo que foi feito upload no campo arquivo
    function displayFileName() {
    // Obtém o elemento de entrada de arquivo
        var fileInput = document.getElementById('arquivo_aluno');

    // Obtém o elemento do span onde o nome do arquivo será exibido
        var fileNameSpan = document.getElementById('file-name-span');

    // Verifica se há arquivos selecionados
        if (fileInput.files && fileInput.files.length > 0) {
        // Obtém o nome do primeiro arquivo selecionado
            var fileName = fileInput.files[0].name;

        // Atualiza o texto do span para mostrar o nome do arquivo
            fileNameSpan.textContent = "Arquivo selecionado: " + fileName;
        } else {
        // Se nenhum arquivo estiver selecionado, exibe uma mensagem padrão
            fileNameSpan.textContent = "Nenhum arquivo selecionado";
        }
    }
    //---------------------------------------------------------------------------------------------------
</script>