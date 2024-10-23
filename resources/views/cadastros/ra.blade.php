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
        <form id="registration-form" method="POST" action="{{ route('register_aluno') }}" enctype="multipart/form-data">
            @csrf

<!--PESQUISA PELO CPF DO ALUNO -->
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Digite o CPF do aluno sem pontos ou traços e clique em PESQUISAR" id="termoPesquisa">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-success" type="button" onclick="pesquisa_aluno();">Pesquisar</button>
                    </div>
                </div>
                <small>Caso tenha mais de um aluno, digite o CPF de qualquer um deles! Lembre-se, este aluno já deve possuir cadastro ATIVO no sistema.</small>
            </div>
            <hr>
<!--PESQUISA PELO CPF DO ALUNO -->
    <div class="divResultados" id="divResultados">
        <h6 style="color: green">Preencha os dados do RESPONSÁVEL pelo aluno: <label id="resultadosPesquisa"></label></h6>
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
                            <input type="file" class="custom-file-input" id="arquivo_resp" aria-describedby="inputGroupFileAddon01" name="arquivo_resp" accept="image/png, image/jpeg" onchange="displayFileName()" required>
                            <label class="custom-file-label" for="arquivo_resp"></label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <span id="file-name-span_resp" style="color: green;"></span>
        <div class="row" style="margin-top: 15px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome_resp">Nome Completo <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Realizar a conferência de letras e acentos!"></i></label>
                    <input class="form-control" id="nome_resp" name="nome_resp" value="{{ old('nome_resp') }}" required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email_resp">Email</label>
                    <input class="form-control" type="email_resp" id="email_resp" name="email_resp" value="{{ old('email_resp') }}" required >
                </div>
                @if ($errors->has('email_resp'))
                    <span class="text-danger">{{ $errors->first('email_resp') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="rg_resp">RG</label>
                    <input type="text" class="form-control" id="rg_resp" name="rg_resp" value="{{ old('rg_resp') }}" placeholder="Somente números" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cpf_resp">CPF <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Verificação automárica"></i></label>
                    <input class="form-control" id="cpf_resp" name="cpf_resp" value="{{ old('cpf_resp') }}" maxlength="11" onfocusout="validarCPF_resp(cpf_resp)" placeholder="Somente números" required>
                    <small id="resultado_cpf_resp"></small>
                    @if ($errors->has('cpf_resp'))
                        <small class="text-danger">{{ $errors->first('cpf_resp') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tel_resp">Telefone (Whatsapp)</label>
                    <input id="tel_resp" type="tel"  maxlength="15" onkeyup="handlePhone(event)" class="form-control{{ $errors->has('tel_resp') ? ' is-invalid' : '' }}" name="tel_resp" required>
                </div>
            </div>
            <div class="col-md-3">
                    <div class="form-group">
                        <label for="cep_resp">CEP</label>
                        <input class="form-control" id="cep_resp" name="cep_resp" required>
                    </div>
                </div>
        </div>
        <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="rua_resp">Logradouro</label>
                        <input class="form-control" id="rua_resp" name="rua_resp" readonly required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="num_casa_resp">Nº</label>
                        <input class="form-control" id="num_casa_resp" name="num_casa_resp" required>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bairro_resp">Bairro</label>
                    <input class="form-control" id="bairro_resp" name="bairro_resp" readonly required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cidade_resp">Cidade</label>
                    <input class="form-control" id="cidade_resp" name="cidade_resp" readonly required>
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
                <label for="num_cnh_resp">Nº CNH</label>
                <input class="form-control" id="num_cnh_resp" name="num_cnh_resp" value="{{ old('num_cnh_resp') }}" placeholder="Somente números">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                        <label for="tipo_cnh_resp">Categoria CNH</label>
                        <select class="form-control" id="tipo_cnh_resp" name="tipo_cnh_resp">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                            <option>AB</option>
                            <option>AC</option>
                            <option>AD</option>
                            <option>AE</option>
                        </select>
                    </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="validade_cnh_resp">Validade CNH</label>
                <input class="form-control" type="date" id="validade_cnh_resp" name="validade_cnh_resp" value="{{ old('validade_cnh_resp') }}" >
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
                <input type="file" class="custom-file-input" id="arquivo_cnh_resp" aria-describedby="inputGroupFileAddon01" name="arquivo_cnh_resp" accept="image/png, image/jpeg" onchange="displayFileName_cnh()" required>
                <label class="custom-file-label" for="arquivo_cnh_resp"></label>
            </div>
        </div>  
    </div>
</div>
</div>
<span id="file-name-span-cnh" style="color: green;"></span>
</div>

<!--INPUTS PREENCHIDOS DE OUTROS FORMULÁRIOS PARA NÃO FICAR NULL NO BANCO-->
<input type="hidden" name="autorizacao" value="ra">
<input type="hidden" name="nome_aluno_resp" id="nome_aluno_resp">
<input type="hidden" name="cpf_aluno_resp" id="cpf_aluno_resp">
<input type="hidden" name="local_aluno" id="local_aluno">
<input type="hidden" name="status_aluno" id="status_aluno" value="0">
<input type="hidden" name="tipo_aluno" id="tipo_aluno" value="RESPONSÁVEL POR ALUNO">


<div class="row" style="margin-top: 30px;">
    <div class="col-12">
        <div class="form-group">
            <button id="envia" type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal_resp">
                Enviar
            </button>
        </div>
    </div>
    
</div>
</div>
</form>


<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmationModal_resp" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 800px; width: 600px;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmação de Dados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 style="color: red;">*Vire o celular para ver todos os dados!</h6>
                <div class="mt-4" style="margin: 20px; height: 600px; width: 500px;">
                    <div class="row bordered-row">
                      <!-- Coluna da esquerda com duas imagens -->
                      <div class="col-4 d-flex flex-column justify-content-center align-items-center" style="height: 600px;">
                         <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                            Foto de rosto:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo_resp" src="" alt="Imagem de perfil"  class="img-fluid" >
                            </div>
                            CNH ou Identidade:
                            <div class="h-50 d-flex align-items-center justify-content-center bordered-row">
                                <img id="confirm-image-arquivo-cnh_resp" src="" alt="Imagem da CNH ou Identidade" class="img-fluid">
                            </div>
                         </div>
                    </div>
                    <!-- Coluna da direita com mais 12 linhas -->
                    <div class="col-8 bordered-row" style="height: 600px;">
                        <!-- Você pode adicionar qualquer conteúdo aqui -->
                        <div class="row">
                          <div class="col">
                              <p><strong>Nome:</strong> <span id="confirm-nome_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>E-mail:</strong> <span id="confirm-email_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>RG:</strong> <span id="confirm-rg_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>CPF:</strong> <span id="confirm-cpf_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Telefone:</strong> <span id="confirm-telefone_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                             <hr>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>CEP:</strong> <span id="confirm-cep_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Logradouro:</strong> <span id="confirm-rua_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>N°:</strong> <span id="confirm-num_casa_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Bairro:</strong> <span id="confirm-bairro_resp"></span></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <p><strong>Cidade:</strong> <span id="confirm-cidade_resp"></span></p>
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
                                  <p><strong>É condutor de veículos:</strong> <span id="confirm-condutor_resp"></span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>N° CNH:</strong> <span id="confirm-num_cnh_resp"></span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Categoria CNH:</strong> <span id="confirm-categoria_cnh_resp"></span></p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <p><strong>Validade CNH:</strong> <span id="confirm-validade_cnh_resp"></span></p>
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
    //PESQUISA DE ALUNO PELO RESPONSÁVEL COM O CPF DO ALUNO
    function pesquisa_aluno() {

        var termoPesquisa = $('#termoPesquisa').val();

        $.ajax({
            url: '{{ route("pesquisa") }}',
            type: 'GET',
            dataType: 'json',
            data: { termo_pesquisa: $('#termoPesquisa').val() }, // Adicione o parâmetro aos dados
            success: function (data) {
                try {
                    exibirResultados(data);
                    // Habilitar ou desabilitar o botão de envio com base nos resultados
                    $('#btnSubmit').prop('disabled', data.length === 0);
                } catch (e) {
                    console.error("Erro ao processar dados JSON: ", e);
                }
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição AJAX: ", error);
                console.log("Resposta do servidor:", xhr.responseText);
            }
        });

        function exibirResultados(resultados) {
            var listaResultados = $('#resultadosPesquisa');
            listaResultados.empty();

            // Verificar se resultados é uma coleção iterável
            if (Array.isArray(resultados) && resultados.length > 0) {
                $('#btnSubmit').prop('enable');
                // Iterar sobre os resultados
                resultados.forEach(function (resultado) {
                    // Verificar se o campo nome está vazio
                    var nomeAluno = resultado.nome_aluno || 'ESTE ALUNO NÃO ESTÁ CADASTRADO!';
                    var localAluno = resultado.local_aluno || 'ESTE ALUNO NÃO ESTÁ CADASTRADO!';

                    listaResultados.append(nomeAluno);
                    // Preencher os inputs com os valores
                    $('#nome_aluno_resp').val(nomeAluno);
                    $('#cpf_aluno_resp').val(termoPesquisa);
                    $('#local_aluno').val(localAluno);
                });

                // Exibir a div se houver resultados
                $('#divResultados').show();
            } else {
                listaResultados.append('<li style="color: red"> ESTE ALUNO NÃO ESTÁ CADASTRADO! </li>');
                // Ocultar a div se não houver resultados
                $('#divResultados').hide();
            }
        }
    };

    //---------------------------------------------------------------------------------------------------
        // O JS que faz a captura dos dados dos inputs e aparece no modal está no 
        // Ele mostra os dados preenchidos e confirma o envio dos dados ou não.
    //---------------------------------------------------------------------------------------------------

    // traz o nome do arquivo que foi feito upload no campo arquivo
    function displayFileName() {
    // Obtém o elemento de entrada de arquivo
        var fileInput = document.getElementById('arquivo_resp');

    // Obtém o elemento do span onde o nome do arquivo será exibido
        var fileNameSpan = document.getElementById('file-name-span_resp');

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
        var fileInput = document.getElementById('arquivo_cnh_resp');

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