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
        <form id="registration-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
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
                            <input type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01" name="arquivo" accept="image/png, image/jpeg" onchange="displayFileName()" required>
                            <label class="custom-file-label" for="arquivo"></label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <span id="file-name-span" style="color: green;"></span>
        <div class="row" style="margin-top: 15px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nome Completo <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Realizar a conferência de letras e acentos!"></i></label>
                    <input class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required >
                </div>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="rg">RG</label>
                    <input type="text" class="form-control" id="rg" name="rg" value="{{ old('rg') }}" placeholder="Somente números" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cpf">CPF <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Verificação automárica"></i></label>
                    <input class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" maxlength="11" onfocusout="validarCPF(cpf)" placeholder="Somente números" required>
                    <small id="resultado"></small>
                    @if ($errors->has('cpf'))
                        <small class="text-danger">{{ $errors->first('cpf') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="email">Telefone (Whatsapp)</label>
                    <input id="telefone" type="tel"  maxlength="15" onkeyup="handlePhone(event)" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nascimento">Data de Nascimento</label>
                    <input id="nascimento" type="date" class="form-control" name="nascimento" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                   <label for="password">Criar senha de acesso</label>
                   <input class="form-control" type="password" id="password" name="password" required>
                   <span id="password-error" style="color: red;"></span> <!-- Para exibir mensagens de erro -->
               </div>

           </div>
           <div class="col-md-6">
            <div class="form-group">
                <label for="password">Confirmar Senha</label>
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                <span id="password-confirmation-error" style="color: red;"></span> <!-- Para exibir mensagens de erro -->
            </div>
        </div>
    </div>
    <hr>
        <div class="row">
             <div class="col-md-3">
                    <div class="form-group">
                        <label for="cep_func">CEP</label>
                        <input class="form-control" id="cep_func" name="cep_func" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rua_func">Logradouro</label>
                        <input class="form-control" id="rua_func" name="rua_func" readonly required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="num_casa_func">Nº</label>
                        <input class="form-control" id="num_casa_func" name="num_casa_func" required>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bairro_func">Bairro</label>
                    <input class="form-control" id="bairro_func" name="bairro_func" readonly required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cidade_func">Cidade</label>
                    <input class="form-control" id="cidade_func" name="cidade_func" readonly required>
                </div>
            </div>
        </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <strong>É condutor de veículos?</strong>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="condutor" id="condutor_sim" value="sim" required>
              <label class="form-check-label" for="condutor_sim">Sim</label>
          </div>
          <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="condutor" id="condutor_nao" value="nao">
              <label class="form-check-label" for="condutor_nao">Não</label>
          </div>
      </div>
  </div>
  <div id="condutor" style="display:none;">
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="num_cnh">Nº CNH</label>
                <input class="form-control" id="num_cnh" name="num_cnh" value="{{ old('num_cnh') }}" placeholder="Somente números">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                        <label for="categoria_cnh">Categoria CNH</label>
                        <select class="form-control" id="categoria_cnh" name="categoria_cnh">
                            <option>A</option>
                            <option>B</option>
                            <option>AB</option>
                            <option>AC</option>
                            <option>AD</option>
                            <option>AE</option>
                        </select>
                    </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="validade_cnh">Validade CNH</label>
                <input class="form-control" type="date" id="validade_cnh" name="validade_cnh" value="{{ old('validade_cnh') }}" >
            </div>
        </div>
    </div>
</div>
<div id="foto_cnh">
    <h6 id="sim_condutor">Faça upload da sua CNH (frente e verso no mesmo arquivo)</h6>
    <h6 id="nao_condutor" style="margin-top: 10px;">Faça upload da sua IDENTIDADE (frente e verso no mesmo arquivo)</h6>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: -15px;">
           <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="arquivo_cnh" aria-describedby="inputGroupFileAddon01" name="arquivo_cnh" accept="image/png, image/jpeg" onchange="displayFileName_cnh()" required>
                <label class="custom-file-label" for="arquivo_cnh"></label>
            </div>
        </div>  
    </div>
</div>
</div>
<span id="file-name-span-cnh" style="color: green;"></span>
</div>

<!--INPUTS PREENCHIDOS DE OUTROS FORMULÁRIOS PARA NÃO FICAR NULL NO BANCO-->
<input type="hidden" name="autorizacao" value="po">
<input type="hidden" name="local" value="ACVBA">
<input type="hidden" name="status" value="0">

<div class="row" style="margin-top: 30px;">
    <div class="col-12">
        <div class="form-group">
            <button id="envia" type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal_morador">
                Enviar
            </button>
        </div>
    </div>
    
</div>

</form>


<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmationModal_morador" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 880px; width: 500px;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmação de Dados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mt-4" style="margin: 20px; height: 600px; width: 400px;">
                    <div class="row bordered-row">
                      <!-- Coluna da esquerda com duas imagens -->
                      <div class="col-4 d-flex flex-column justify-content-center align-items-center" style="height: 680px;">
                         <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                            Foto de rosto:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo" src="" alt="Imagem de perfil"  class="img-fluid" >
                            </div>
                            CNH ou Identidade:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo-cnh" src="" alt="Imagem da CNH ou Identidade" class="img-fluid">
                            </div>
                         </div>
                    </div>
                    <!-- Coluna da direita com mais 12 linhas -->
                    <div class="col-8 bordered-row" style="height: 680px;">
                        <!-- Você pode adicionar qualquer conteúdo aqui -->
                        <div class="row">
                          <div class="col">
                              <p><strong>Nome:</strong> <span id="confirm-name"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>E-mail:</strong> <span id="confirm-email"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>RG:</strong> <span id="confirm-rg"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>CPF:</strong> <span id="confirm-cpf"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Telefone:</strong> <span id="confirm-telefone"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Data de Nascimento:</strong> <span id="confirm-nascimento"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Senha:</strong> <span id="confirm-password"></span></p>
                          </div>
                      </div>
                       <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>CEP:</strong> <span id="confirm-cep_func"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Logradouro:</strong> <span id="confirm-rua_func"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>N°:</strong> <span id="confirm-num_casa_func"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Bairro:</strong> <span id="confirm-bairro_func"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Cidade:</strong> <span id="confirm-cidade_func"></span></p>
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
                                  <p><strong>É condutor de veículos:</strong> <span id="confirm-condutor"></span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>N° CNH:</strong> <span id="confirm-num_cnh"></span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Categoria CNH:</strong> <span id="confirm-categoria_cnh"></span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Validade CNH:</strong> <span id="confirm-validade_cnh"></span></p>
                              </div>
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
        var fileInput = document.getElementById('arquivo');

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
    // traz o nome do arquivo que foi feito upload no campo arquivo
    function displayFileName_cnh() {
    // Obtém o elemento de entrada de arquivo
        var fileInput = document.getElementById('arquivo_cnh');

    // Obtém o elemento do span onde o nome do arquivo será exibido
        var fileNameSpan = document.getElementById('file-name-span-cnh');

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
    // faz a comparação das senhas nos inputs de password
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('register-form');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const passwordError = document.getElementById('password-error');
        const passwordConfirmationError = document.getElementById('password-confirmation-error');

        function validatePasswords() {
            if (password.value !== passwordConfirmation.value) {
                passwordConfirmationError.textContent = 'As senhas não correspondem.';
                return false;
            } else {
                passwordConfirmationError.textContent = '';
                return true;
            }
        }

        password.addEventListener('input', validatePasswords);
        passwordConfirmation.addEventListener('input', validatePasswords);

        form.addEventListener('submit', function(event) {
            if (!validatePasswords()) {
            event.preventDefault(); // Impede o envio do formulário
        }
    });
    });
    //---------------------------------------------------------------------------------------------------
</script>