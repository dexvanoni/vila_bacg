    @extends('layouts.app')

    @section('content')
                    @switch ($param) 
                        @case ('ad')
                            @php $perfil = 'Administrador'; @endphp
                            @break
                        @case ('so')
                            @php $perfil = 'Sócio'; @endphp
                            @break
                        @case ('mo')
                            @php $perfil = 'Morador'; @endphp
                            @break
                        @case ('fe')
                            @php $perfil = 'Funcionário Escola'; @endphp
                            @break
                        @case ('ef')
                            @php $perfil = 'Efetivo BACG'; @endphp
                            @break
                        @case ('ra')
                            @php $perfil = 'Responsável por Aluno'; @endphp
                            @break
                        @case ('po')
                            @php $perfil = 'Portaria'; @endphp
                            @break
                        @case ('in')
                            @php $perfil = 'Inteligência'; @endphp
                            @break
                        @case ('al')
                            @php $perfil = 'Aluno'; @endphp
                            @break
                        @default
                            @php $perfil = 'Desconhecido'; @endphp
                    @endswitch
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    @endif
                    <div class="card">
                        <div class="card-header">Cadastro de {{ $perfil }}</div>
                        <div class="card-body">
                            <h6 style="color: red;">*TODOS os campos são de preenchimento OBRIGATÓRIO!</h6>
                <!--CONTEÚDO DINÂMICO DE ACORDO COM TIPO DE CADASTRO SELECIONADO NA VIEW CADASTROS.SELECT-->
                @if($param == 'ad')
                    <h3>Este tipo de usuário não pode ser cadastrado através de URL!</h3>
                    <h4>Entre em contato com um Administrador!</h4>
                @endif
                @if($param == 'mo')
                    @include('cadastros.mo')
                @endif
                @if($param == 'po')
                    @include('cadastros.po')
                @endif
                @if($param == 'so')
                    @include('cadastros.so')
                @endif
                @if($param == 'ra')
                    @include('cadastros.ra')
                @endif
                @if($param == 'al')
                    @include('cadastros.al')
                @endif
                @if($param == 'fe')
                    @include('cadastros.fe')
                @endif
                @if($param == 'ef')
                    @include('cadastros.ef')
                @endif
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


<script type="text/javascript">

    $(function () {
        $('#arquivo_aluno').change(function() {
           $('.nomeArquivo_aluno').html('<b>Arquivo Selecionado:</b> ' + $(this).val());
       });
    });
    $(function () {
        $('#arquivo').change(function() {
           $('.nomeArquivo').html('<b>Arquivo Selecionado:</b> ' + $(this).val());
       });
    });
    $(function () {
        $('#arquivo_cnh_resp').change(function() {
           $('.nomeArquivo_cnh_resp').html('<b>Arquivo Selecionado:</b> ' + $(this).val());
       });
    });
    $(function () {
        $('#arquivo_resp').change(function() {
           $('.nomeArquivo_resp').html('<b>Arquivo Selecionado:</b> ' + $(this).val());
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
        document.querySelector('#btnRegistrar').disabled = false;
    } else {
        verificaCPF = 'Este CPF é INVÁLIDO! Digite somente NÚMEROS.';
        document.getElementById("resultado").innerHTML = verificaCPF;
        document.querySelector('#btnRegistrar').disabled = true;
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
    verificacpf_aluno = 'CPF Válido!';
    document.getElementById("resultado_aluno").innerHTML = verificacpf_aluno;
    document.querySelector('#btnSubmit').disabled = false;
} else {
    verificacpf_aluno = 'Este CPF é INVÁLIDO! Digite somente números.';
    document.getElementById("resultado_aluno").innerHTML = verificacpf_aluno;
    document.querySelector('#btnSubmit').disabled = true;
};

}


function validarCPF_resp() {
    cpf_resp = $('#cpf_resp').val();

    function isCPF(cpf_resp = 0){

        cpf_resp  = cpf_resp.replace(/\.|-/g,"");

        if(!validaPrimeiroDigito(cpf_resp))
         return false;
     if(!validaSegundoDigito(cpf_resp))
         return false;

     return true;

 }
 var sum = 0;

 function validaPrimeiroDigito(cpf_resp = null){
    let fDigit = (sumFristDigit(cpf_resp) * 10) % 11;
    fDigit = (fDigit == 10 || fDigit == 11 ) ? 0 : fDigit; 
    if(fDigit != cpf_resp[9])
        return false
    return true;
}
function validaSegundoDigito(cpf_resp = null){
    let sDigit = (sumSecondDigit(cpf_resp) * 10) % 11;
    sDigit = (sDigit == 10 || sDigit == 11 ) ? 0 : sDigit;

    if(sDigit != cpf_resp[10])
        return false
    return true;
}


sumFristDigit = function(cpf_resp, position=0, sum=0){
    if(position > 9)
        return 0;
    return sum + sumFristDigit(cpf_resp,position+1,cpf_resp[position] * ((cpf_resp.length-1)-position));
}


sumSecondDigit = function(cpf_resp, position=0, sum=0){
    if(position > 10)
        return 0;
    return sum + sumSecondDigit(cpf_resp,position+1,cpf_resp[position] * ((cpf_resp.length)-position));
}

var verificacpf_resp;

if (isCPF(cpf_resp) == true) {
    verificacpf_resp = 'CPF Válido!';
    document.getElementById("resultado_cpf_resp").innerHTML = verificacpf_resp;
    document.querySelector('#btnSubmit').disabled = false;
} else {
    verificacpf_resp = 'Este CPF é INVÁLIDO! Digite somente números.';
    document.getElementById("resultado_cpf_resp").innerHTML = verificacpf_resp;
    document.querySelector('#btnSubmit').disabled = true;
};

}

</script>
@endsection
