@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Cadastro de Usuários</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h6 style="color: red;">*TODOS os campos são de preenchimento OBRIGATÓRIO!</h6><br>
                        <h5 style="color: green;">** Este cadastro passará por análise para ser EFETIVADO!</h5><br>
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
                            <div class="col-md-3">
                                <label for="email">Telefone (Whatsapp)</label>
                                <input id="telefone" type="tel"  maxlength="15" onkeyup="handlePhone(event)" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ old('telefone') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="email">Ramal</label>
                                <input id="ramal" maxlength="4" type="text" class="form-control{{ $errors->has('ramal') ? ' is-invalid' : '' }}" name="ramal" value="{{ old('ramal') }}">
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
                        <!--MÓDULO DE AUTORIZAÇÕES-->

                        <hr>
                        <h4>Acessos e autorizações</h4>

                        <div class="form-group row mb-0 offset-md-1">
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="pe" value="pe"  onclick ="aut();">
                              <label class="form-check-label" for="pe">Permissionário</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="de" value="de" onclick="aut();">
                              <label class="form-check-label" for="de">Dependente</label>
                            </div> 
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="st" value="st" onclick="aut();">
                              <label class="form-check-label" for="st">Sócio-Titular</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="sd" value="sd" onclick="aut();">
                              <label class="form-check-label" for="sd">Sócio-Dependente</label>
                            </div> 
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="fe" value="fe" onclick="aut();">
                              <label class="form-check-label" for="fe">Funcionário Escola</label>
                            </div>    
                        </div>
                        <br>
                        <div class="form-group row mb-0 offset-md-1">
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="ra" value="ra" onclick="aut();">
                              <label class="form-check-label" for="ra">Responsável Aluno</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="ps" value="ps" onclick="aut();">
                              <label class="form-check-label" for="ps">Prestador de Serviço</label>
                            </div> 
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="po" value="po" onclick="aut();">
                              <label class="form-check-label" for="po">Portaria</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="si" value="si" onclick="aut();">
                              <label class="form-check-label" for="si">Síndico</label>
                            </div> 
                            <div class="form-check form-check-inline">
                              <input name="autoriza" class="form-check-input" type="checkbox" id="ad" value="ad" onclick="aut();">
                              <label class="form-check-label" for="ad">Administrador</label>
                            </div>    
                        </div>

                        <input type="hidden" name="autorizacao" id="autorizacao" value="">

                        <br>
                        <!--TÉRMINO DO MÓDULO DE AUTORIZAÇÕES-->

                        <!--MÓDULO DE VINCULAÇÕES-->

                        <hr>
                        <h4>Vinculações</h4>

                             <div class="form-group">
                                <label for="local">Local onde o cadastrado terá acesso</label>
                                <select class="form-control" id="local" name="local">
                                  @php
                                    $locais = App\Local::all();
                                  @endphp
                                  <option>Selecione...</option>
                                  @foreach ($locais as $l)
                                    <option>{{$l->local}}</option>
                                  @endforeach
                                </select>
                              </div>

                        <!--TÉRMINO DO MÓDULO DE AUTORIZAÇÕES-->
                        <!-- O USUÁRIO REALIZA O CADASTRO E FICA COM O STATUS ZERO, OU SEJA, AINDA BLOQUEADO PARA UTILIZAÇÃO-->
                        <input type="hidden" name="status" value="0">
                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validarCPF() {
        cpf = $('#cpf').val();
    // Codigo relativo ao video 3   
                  
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

    function aut() {
    
        var auts = new Array();

        $("input:checkbox[name=autoriza]:checked").each(function(){
            auts.push($(this).val());
        });

        $("#autorizacao").val(auts);

}   

</script>
@endsection
