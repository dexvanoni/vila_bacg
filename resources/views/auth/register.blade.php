    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Cadastro de Usuários</div>
                    <div class="card-body">
                        <h6 style="color: red;">*TODOS os campos são de preenchimento OBRIGATÓRIO!</h6>
                        <!--MÓDULO DE AUTORIZAÇÕES (PERFIS)-->

                        <hr>
                        <h4>TIPO DE CADASTRO</h4>

                        <div class="form-group row mb-0 offset-md-1">
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input org tod" type="checkbox" id="ad" value="ad" onclick="aut();org();">
                              <label class="form-check-label" for="ad">Administrador</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input alun tod" type="checkbox" id="al" value="al"  onclick ="aut();aluno()">
                              <label class="form-check-label" for="al">Aluno</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input org tod" type="checkbox" id="de" value="de" onclick="aut();org();">
                              <label class="form-check-label" for="de">Dependente</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input alun" type="checkbox" id="fe" value="fe" onclick="aut();funcionario()">
                              <label class="form-check-label" for="fe">Funcionário Escola</label>
                          </div>     
                          <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input org tod" type="checkbox" id="pe" value="pe"  onclick ="aut();org();">
                              <label class="form-check-label" for="pe">Permissionário</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input org tod" type="checkbox" id="po" value="po" onclick="aut();org();">
                              <label class="form-check-label" for="po">Portaria</label>
                          </div>
                      </div>
                      <br>
                      <div class="form-group row mb-0 offset-md-1">
                        <div class="form-check form-check-inline">
                          <input name="autoriza" class="form-check-input org tod" type="checkbox" id="ps" value="ps" onclick="aut();org();">
                          <label class="form-check-label" for="ps">Prestador de Serviço</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input name="autoriza" class="form-check-input alun tod" type="checkbox" id="ra" value="ra" onclick="aut();resp_aluno()">
                          <label class="form-check-label" for="ra">Responsável Aluno</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input name="autoriza" class="form-check-input org tod" type="checkbox" id="si" value="si" onclick="aut();org();">
                          <label class="form-check-label" for="si">Síndico</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input name="autoriza" class="form-check-input org tod" type="checkbox" id="sd" value="sd" onclick="aut();org();">
                          <label class="form-check-label" for="sd">Sócio-Dependente</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input name="autoriza" class="form-check-input org tod" type="checkbox" id="st" value="st" onclick="aut();org();">
                          <label class="form-check-label" for="st">Sócio-Titular</label>
                      </div>
                  </div>


                  <hr>
                  <!--TÉRMINO DO MÓDULO DE AUTORIZAÇÕES-->

                  <!--CADASTRO DE PESSOAL ORGÂNICO - CRIA LOGIN NO SISTEMA -->
                  <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="cadastro_organico">
                        <input type="hidden" name="autorizacao" id="autorizacao" value="">
                        <!--MÓDULO DE VINCULAÇÕES-->
                        <h4>Vinculações</h4>

                        <div class="form-group">
                            <label for="local">Local onde o cadastrado terá acesso</label>
                            <select class="form-control" id="local" name="local">
                              @php
                              $locais = App\Local::all();
                              @endphp
                              <option>Selecione...</option>
                              <option>ACVBA</option>
                              <option>EMEI Maria Josefina</option>
                              <option>ESCOLA Y-JUCA PIRAMA</option>
                              <option>ALOF</option>
                              <option>ALSS</option>
                              <option>ALCTS</option>
                              <option>GINÁSIO</option>
                              <option>PACG</option>
                              @foreach ($locais as $l)
                              <option>{{$l->local}}</option>
                              @endforeach
                          </select>
                      </div>
                      <hr>
                      <!--TÉRMINO DO MÓDULO DE AUTORIZAÇÕES-->

                      <h4>Dados Pessoais</h4>
                      <h6>Faça upload da foto</h6>
                      <div class="row">
                        <div class="col-md-12">
                         <div class="form-group">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01" name="arquivo" accept="image/png, image/jpeg">
                                <label class="custom-file-label" for="arquivo">Clique aqui...</label>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="nomeArquivo" style="margin-left: 20px;"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome Completo <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Realizar a conferência de letras e acentos!"></i></label>
                        <input class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Este será o login no sistema."></i></label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="email">Senha <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Senha padrão: @!T1q2w3e4r. Informar ao usuário!"></i></label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="@!T1q2w3e4r" value="@!T1q2w3e4r" required>
                </div>
                <div class="col-md-3">
                    <label for="email">Confirmar Senha</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="@!T1q2w3e4r" required>
                </div>
                <div class="col-md-6">
                    <label for="email">Telefone (Whatsapp)</label>
                    <input id="telefone" type="tel"  maxlength="15" onkeyup="handlePhone(event)" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ old('telefone') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="email">Tipo de Usuário <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="O usuário virtual não participa de Assembléias, não vota e não faz qualquer publicação!"></i></label>
                    <select class="form-control" id="tipo" name="tipo">
                      <option>Existente</option>
                      <option>Virtual (SOMENTE ADMINISTRADORES)</option>
                  </select>
              </div>
              <div class="col-md-4">
                <label for="rg">RG</label>
                <input class="form-control" id="rg" name="rg" value="{{ old('rg') }}" required>
            </div>
            <div class="col-md-4">
                <label for="cpf">CPF <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Verificação automárica"></i></label>
                <input class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" maxlength="11" onfocusout="validarCPF(cpf)" required>
                <small id="resultado"></small>
            </div>
        </div>
        <!--FUNCIONARIOS-->
        <div id="dados_funcionario">
            <h4>Dados Adicionais - Funcionários EMEI ou Escola Y-Juca Pirama</h4>

        </div>
        <hr>
        <!--TERMINA FUNCIONARIOS-->
        <input type="hidden" name="status" value="0">
        <div class="form-group row mb-0">
            <div class="col-md-7 offset-md-5">
                <button type="submit" class="btn btn-success">
                    REGISTRAR
                </button>
            </div>
        </div>
    </div>
    
</form>
<!--TERMINA O FORMULÁRIO DE CADASTRO DOS ORGÂNICOS-->

<!--##################################################################################################################################-->
<!--CADASTRO DE ALUNOS E RESPONSÁVEIS - TABELA alunos_resp - NÃO CRIA LOGIN DE ACESSO AO SISTEMA-->
<form method="POST" action="{{ route('register_aluno') }}" enctype="multipart/form-data">
    @csrf
    <div id="cadastro_escolas">

        <!--ALUNOS-->
        <div id="dados_alunos">
            <h4>Aluno EMEI ou Escola Y-Juca Pirama</h4>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="nome_aluno">Nome Completo DO ALUNO <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Digite o nome completo do ALUNO"></i></label>
                        <input class="form-control" id="nome_aluno" name="nome_aluno" value="{{ old('nome_aluno') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="local_aluno">Local <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Selecione a instituição que o ALUNO estuda."></i></label>
                        <select class="form-control" id="local_aluno" name="local_aluno">
                            <option>Selecione...</option>
                            <option>EMEI Prof. Maria Josefina</option>
                            <option>Escola Maj. Av. Y-Juca Pirama</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dt_nascimento_aluno">Dt. Nascimento DO ALUNO <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Digite a data de nascimento do ALUNO"></i></label>
                        <input type="date" class="form-control" id="dt_nascimento_aluno" name="dt_nascimento_aluno">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="serie_aluno">Série <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Selecione a série do ALUNO"></i></label>
                        <select class="form-control" id="serie_aluno" name="serie_aluno">
                            <option>Selecione...</option>
                            <option>1º ano Fundamental - A</option>
                            <option>1º ano Fundamental - B</option>
                            <option>1º ano Fundamental - C</option>
                            <option>----------------------</option>
                            <option>2º ano Fundamental - A</option>
                            <option>2º ano Fundamental - B</option>
                            <option>2º ano Fundamental - C</option>
                            <option>----------------------</option>
                            <option>3º ano Fundamental - A</option>
                            <option>3º ano Fundamental - B</option>
                            <option>3º ano Fundamental - C</option>
                            <option>----------------------</option>
                            <option>4º ano Fundamental - A</option>
                            <option>4º ano Fundamental - B</option>
                            <option>4º ano Fundamental - C</option>
                            <option>----------------------</option>
                            <option>5º ano Fundamental - A</option>
                            <option>5º ano Fundamental - B</option>
                            <option>5º ano Fundamental - C</option>
                            <option>----------------------</option>
                            <option>6º ano Fundamental - A</option>
                            <option>6º ano Fundamental - B</option>
                            <option>6º ano Fundamental - C</option>
                            <option>----------------------</option>
                            <option>7º ano Fundamental - A</option>
                            <option>7º ano Fundamental - B</option>
                            <option>7º ano Fundamental - C</option>
                            <option>----------------------</option>
                            <option>8º ano Fundamental - A</option>
                            <option>8º ano Fundamental - B</option>
                            <option>8º ano Fundamental - C</option>
                            <option>----------------------</option>
                            <option>9º ano Fundamental - A</option>
                            <option>9º ano Fundamental - B</option>
                            <option>9º ano Fundamental - C</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="cpf_aluno">CPF DO ALUNO <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Verificação automárica"></i></label>
                    <input class="form-control" id="cpf_aluno" name="cpf_aluno" value="{{ old('cpf_aluno') }}" maxlength="11" onfocusout="validarCPF_aluno(cpf_aluno)" >
                    <small id="resultado"></small>
                </div>
                <div class="col-md-4">
                    <label for="rg_aluno">RG DO ALUNO</label>
                    <input class="form-control" id="rg_aluno" name="rg_aluno" value="{{ old('rg_aluno') }}" >
                </div>
                <div class="col-md-4">
                    <label for="cep_aluno">CEP</label>
                    <input class="form-control" id="cep_aluno" name="cep_aluno">
                </div>
            </div> 
            <div class="row">
                <div class="col-md-4">
                    <label for="rua_aluno">Logradouro</label>
                    <input class="form-control" id="rua_aluno" name="rua_aluno" disabled>
                </div>
                <div class="col-md-2">
                    <label for="num_casa_aluno">Nº</label>
                    <input class="form-control" id="num_casa_aluno" name="num_casa_aluno">
                </div>
                <div class="col-md-3">
                    <label for="bairro_aluno">Bairro</label>
                    <input class="form-control" id="bairro_aluno" name="bairro_aluno" disabled>
                </div>
                <div class="col-md-3">
                    <label for="cidade_aluno">Cidade</label>
                    <input class="form-control" id="cidade_aluno" name="cidade_aluno" disabled>
                </div>
            </div>
            <hr>
            <h6>Faça upload do seu Documento (RG, CNH, etc)</h6>
            <span style="color: red;">Somente arquivo JPEG, PNG ou PDF de até 2MB</span>
            <div class="row">
                <div class="col-md-12">
                 <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="arquivo_aluno" aria-describedby="inputGroupFileAddon02" name="arquivo_aluno" accept="image/png, image/jpeg, .pdf" size="2000000">
                        <label class="custom-file-label" for="arquivo_aluno">Clique aqui...</label>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <input type="hidden" name="tipo_aluno" id="tipo_aluno">
    <div class="row">
        <div class="nomeArquivo_aluno" style="margin-left: 20px;"></div>
    </div>       
</div>
<!--TERMINA ALUNOS-->

<!--RESPONSÁVEIS-->
<div id="dados_resp">
    <h4>Responsáveis por aluno EMEI ou Escola Y-Juca Pirama</h4>

    <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Digite o CPF do aluno e clique em PESQUISAR" id="termoPesquisa">
        </div>
        <div class="col-md-6">
            <button class="btn btn-secondary" type="button" onclick="pesquisa_aluno();">Pesquisar</button>
        </div>
    </div>
    <ul id="resultadosPesquisa"></ul>
    <hr>


    <!--SÓ ABRE PARA CONTINUAÇÃO DO PREENCHIMENTO SE O CPF DO ALUNO FOR ENCONTRADO-->
    <div class="divResultados" id="divResultados">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name_aluno_resp">Nome Completo <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Digite o seu nome completo"></i></label>
                    <input class="form-control" id="name_aluno_resp" name="name_aluno_resp" value="{{ old('name_aluno_resp') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dt_nascimento_resp">Dt. Nascimento DO ALUNO <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Digite a data de nascimento do ALUNO"></i></label>
                    <input type="date" class="form-control" id="dt_nascimento_resp" name="dt_nascimento_resp">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="serie_resp">Série <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Selecione a série do ALUNO"></i></label>
                    <select class="form-control" id="serie_resp" name="serie_resp">
                        <option>Selecione...</option>
                        <option>1º ano Fundamental - A</option>
                        <option>1º ano Fundamental - B</option>
                        <option>1º ano Fundamental - C</option>
                        <option>----------------------</option>
                        <option>2º ano Fundamental - A</option>
                        <option>2º ano Fundamental - B</option>
                        <option>2º ano Fundamental - C</option>
                        <option>----------------------</option>
                        <option>3º ano Fundamental - A</option>
                        <option>3º ano Fundamental - B</option>
                        <option>3º ano Fundamental - C</option>
                        <option>----------------------</option>
                        <option>4º ano Fundamental - A</option>
                        <option>4º ano Fundamental - B</option>
                        <option>4º ano Fundamental - C</option>
                        <option>----------------------</option>
                        <option>5º ano Fundamental - A</option>
                        <option>5º ano Fundamental - B</option>
                        <option>5º ano Fundamental - C</option>
                        <option>----------------------</option>
                        <option>6º ano Fundamental - A</option>
                        <option>6º ano Fundamental - B</option>
                        <option>6º ano Fundamental - C</option>
                        <option>----------------------</option>
                        <option>7º ano Fundamental - A</option>
                        <option>7º ano Fundamental - B</option>
                        <option>7º ano Fundamental - C</option>
                        <option>----------------------</option>
                        <option>8º ano Fundamental - A</option>
                        <option>8º ano Fundamental - B</option>
                        <option>8º ano Fundamental - C</option>
                        <option>----------------------</option>
                        <option>9º ano Fundamental - A</option>
                        <option>9º ano Fundamental - B</option>
                        <option>9º ano Fundamental - C</option>
                    </select>
                </div>
            </div>
        </div>


    </div> <!--INPUTS DE CADASTRO DO RESPONSÁVEL-->
</div>

<!--TERMINA RESPONSÁVEIS-->
<!--FIM DOS DADOS ADICIONAIS-->
<br>
<div class="form-group row mb-0">
    <div class="col-md-7 offset-md-5">
        <button type="submit" class="btn btn-primary" id="btnSubmit">
            CADASTRAR
        </button>
    </div>
</div>
</div>
<!-- O USUÁRIO REALIZA O CADASTRO E FICA COM O STATUS ZERO, OU SEJA, AINDA BLOQUEADO PARA UTILIZAÇÃO-->
<input type="hidden" name="status" value="0">
</form>
<!--TERMINA CADASTRO DE ALUNOS E RESPONSÁVEIS-->
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
window.addEventListener('load', function() {
  alert('IMPORTANTE: \nEste cadastro passará por análise para ser EFETIVADO!');
       // 4th
});

</script>

<script>
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

                listaResultados.append('<li> Nome do aluno: ' + nomeAluno + '</li>');
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



</script>

<script type="text/javascript">
$(function () {
    $('#arquivo_aluno').change(function() {
     $('.nomeArquivo_aluno').html('<b>Arquivo Selecionado:</b> ' + $(this).val());
 });
});
</script>

<script type="text/javascript">
tipo_aluno = '0';

function validarCPF() {
cpf = $('#cpf').val();

function isCPF(cpf = 0){

    cpf  = cpf.replace(/\.|-/g,"");

    if(!validaPrimeiroDigito(cpf))
       return false;
   if(!validaSegundoDigito(cpf))
       return false;

   return true;

}
var sum = 0;

function validaPrimeiroDigito(cpf = null){
let fDigit = (sumFristDigit(cpf) * 10) % 11;
fDigit = (fDigit == 10 || fDigit == 11 ) ? 0 : fDigit; 
if(fDigit != cpf[9])
    return false
return true;
}
function validaSegundoDigito(cpf = null){
let sDigit = (sumSecondDigit(cpf) * 10) % 11;
sDigit = (sDigit == 10 || sDigit == 11 ) ? 0 : sDigit;

if(sDigit != cpf[10])
    return false
return true;
}


sumFristDigit = function(cpf, position=0, sum=0){
if(position > 9)
    return 0;
return sum + sumFristDigit(cpf,position+1,cpf[position] * ((cpf.length-1)-position));
}


sumSecondDigit = function(cpf, position=0, sum=0){
if(position > 10)
    return 0;
return sum + sumSecondDigit(cpf,position+1,cpf[position] * ((cpf.length)-position));
}

var verificaCPF;

if (isCPF(cpf) == true) {
verificaCPF = 'CPF Válido!';
document.getElementById("resultado").innerHTML = verificaCPF;
} else {
verificaCPF = 'Este CPF é INVÁLIDO! Digite novamente.';
document.getElementById("resultado").innerHTML = verificaCPF;
};

}

function validarCPF_aluno() {
cpf_aluno = $('#cpf_aluno').val();

function isCPF(cpf_aluno = 0){

    cpf_aluno  = cpf_aluno.replace(/\.|-/g,"");

    if(!validaPrimeiroDigito(cpf_aluno))
       return false;
   if(!validaSegundoDigito(cpf_aluno))
       return false;

   return true;

}
var sum = 0;

function validaPrimeiroDigito(cpf_aluno = null){
let fDigit = (sumFristDigit(cpf_aluno) * 10) % 11;
fDigit = (fDigit == 10 || fDigit == 11 ) ? 0 : fDigit; 
if(fDigit != cpf_aluno[9])
    return false
return true;
}
function validaSegundoDigito(cpf_aluno = null){
let sDigit = (sumSecondDigit(cpf_aluno) * 10) % 11;
sDigit = (sDigit == 10 || sDigit == 11 ) ? 0 : sDigit;

if(sDigit != cpf_aluno[10])
    return false
return true;
}


sumFristDigit = function(cpf_aluno, position=0, sum=0){
if(position > 9)
    return 0;
return sum + sumFristDigit(cpf_aluno,position+1,cpf_aluno[position] * ((cpf_aluno.length-1)-position));
}


sumSecondDigit = function(cpf_aluno, position=0, sum=0){
if(position > 10)
    return 0;
return sum + sumSecondDigit(cpf_aluno,position+1,cpf_aluno[position] * ((cpf_aluno.length)-position));
}

var verificacpf_aluno;

if (isCPF(cpf_aluno) == true) {
verificacpf_aluno = 'CPF do aluno Válido!';
document.getElementById("resultado").innerHTML = verificaCPF;
} else {
verificacpf_aluno = 'Este CPF é INVÁLIDO! Digite novamente.';
document.getElementById("resultado").innerHTML = verificaCPF;
};

}

function aut() {

var auts = new Array();

$("input:checkbox[name=autoriza]:checked").each(function(){
    auts.push($(this).val());
});
    $("#autorizacao").val(auts);
}

function org() {

    if($("#ad").is(":checked") || $("#de").is(":checked") || $("#pe").is(":checked") || $("#po").is(":checked") || $("#ps").is(":checked") || $("#si").is(":checked") || $("#sd").is(":checked") || $("#st").is(":checked")) {
        $("#cadastro_organico").show(300);
    } else {
        $("#cadastro_organico").hide(300);
    }
}

function aluno() {

    if($("#al").is(":checked")) {
        tipo_aluno = "ALUNO";
        $('#tipo_aluno').val(tipo_aluno);
        $("#cadastro_escolas").show();
        $("#dados_alunos").show(300);
        $("#cadastro_organico").hide(300);
        document.querySelector('#btnSubmit').disabled = false;
    } else {
        $("#cadastro_escolas").hide();
        $("#dados_alunos").hide(200);
    }
}

function funcionario() {

    if($("#fe").is(":checked")) {
        $("#cadastro_organico").show(300);
        $("#dados_funcionario").show(300);
    } else {
        $("#cadastro_organico").hide(300);
        $("#dados_funcionario").hide(200);
    }
}

function resp_aluno() {

    if($("#ra").is(":checked")) {
        tipo_aluno = "RESPONSÁVEL POR ALUNO";
        $('#tipo_aluno').val(tipo_aluno);
        $("#cadastro_escolas").show(300);
        $("#dados_resp").show(300);
        $("#cadastro_organico").hide(300);
        alert('Sr. Responsável! \nRealize o cadastro do aluno ANTES DE FAZER O SEU CADASTRO!');
        document.querySelector('#btnSubmit').disabled = true;
    } else {
        $("#cadastro_escolas").hide(300);
        $("#dados_resp").hide(200);
    }
}

document.addEventListener("DOMContentLoaded", function () {
  var controlCheckbox = document.getElementById("al");
      var controlledCheckboxes = document.querySelectorAll(".org");

          controlCheckbox.addEventListener("change", function () {
            if (controlCheckbox.checked) {
              // Se o checkbox de controle estiver marcado, desative os outros checkboxes
              controlledCheckboxes.forEach(function (checkbox) {
                checkbox.disabled = true;
                checkbox.checked = false;
            });
          } else {
              // Se o checkbox de controle não estiver marcado, ative os outros checkboxes
              controlledCheckboxes.forEach(function (checkbox) {
                checkbox.disabled = false;
            });
          }
      });
  });

              document.addEventListener("DOMContentLoaded", function () {
                  var controlCheckbox = document.getElementById("ra");
                      var controlledCheckboxes = document.querySelectorAll(".org");

                          controlCheckbox.addEventListener("change", function () {
                            if (controlCheckbox.checked) {
              // Se o checkbox de controle estiver marcado, desative os outros checkboxes
                              controlledCheckboxes.forEach(function (checkbox) {
                                checkbox.disabled = true;
                                checkbox.checked = false;
                            });
                          } else {
              // Se o checkbox de controle não estiver marcado, ative os outros checkboxes
                              controlledCheckboxes.forEach(function (checkbox) {
                                checkbox.disabled = false;
                            });
                          }
                      });
                  });


                              document.addEventListener("DOMContentLoaded", function () {
                                  var controlCheckbox = document.getElementById("fe");
                                      var controlledCheckboxes = document.querySelectorAll(".tod");

                                          controlCheckbox.addEventListener("change", function () {
                                            if (controlCheckbox.checked) {
              // Se o checkbox de controle estiver marcado, desative os outros checkboxes
                                              controlledCheckboxes.forEach(function (checkbox) {
                                                checkbox.disabled = true;
                                                checkbox.checked = false;
                                            });
                                          } else {
              // Se o checkbox de controle não estiver marcado, ative os outros checkboxes
                                              controlledCheckboxes.forEach(function (checkbox) {
                                                checkbox.disabled = false;
                                            });
                                          }
                                      });
                                  });


                              </script>
                              @endsection
