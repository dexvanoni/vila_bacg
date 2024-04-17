@extends('layouts.app')

@section('style_morador')
body {
    background-color: #e6e6e6; /* Cinza claro */
}
.custom-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.custom-box {
    background-color: #ffffff; /* Branco */
    border-radius: 10px; /* Bordas arredondadas */
    padding: 20px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.3); /* Sombra */
}

@endsection



@section('content')
<div class="container">
 <!-- FORMULÁRIO DOS LEITORES DE QR-CODE DE ENTRADA E SAÍDA DE MORADORES-->
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="custom-container">
                        <div class="custom-box">

                            <!--AVISOS de ENTRADA-->

        @if(session('neg_usuario_bloqueado'))
        <div class="row" style="background-color: #D8BFD8; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>ENTRADA NÃO AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #D8BFD8; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>O status deste usuário pode estar BLOQUEADO!</label></h4>
                </div>    
                <div class="row" style="background-color: #D8BFD8; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Possíveis problemas: Novo cadastro, baixa, transferência, etc.</label></h4>
                </div>
        @endif
        @if(session('neg_encontrado'))
        <div class="row" style="background-color: #D8BFD8; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>ENTRADA NÃO AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #D8BFD8; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Usuário não encontrado!</label></h4>
                </div>
        @endif

        @if(session('success'))
        <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>ENTRADA AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Sr(a) {{session('nome')}}</label></h4>
                </div>    
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Local: {{session('local')}}</label></h4>
                </div>       

                <hr>
                <div class="row justify-content-center">
                    <img src = "{{ asset('storage/usuarios/'.session('arquivo')) }}" class="img-fluid" width="200px" height="200px" alt="SEM FOTO">    
                </div>
                <hr>
        @endif

        @if(session('success_aluno'))
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>ENTRADA AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Aluno: {{session('nome_do_aluno')}}</label></h4>
                </div>    
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Instituição: {{session('local_do_aluno')}}</label></h4>
                </div>       

                <hr>
                <div class="row justify-content-center">
                    <img src = "{{ asset('storage/alunos/'.session('arquivo')) }}" class="img-fluid" width="200px" height="200px" alt="SEM FOTO">    
                </div>
                <hr>
        @endif

        @if(session('hora_neg'))
        <div class="row" style="background-color: #D8BFD8; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>ENTRADA NÃO PERMITIDA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #D8BFD8; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Aluno não morador da Vila BACG!</label></h4>
                </div>    
                <div class="row" style="background-color: #D8BFD8; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Horário ou dia com bloqueio de movimentação!</label></h4>
                </div>       
        @endif

        @if(session('success_resp'))
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>ENTRADA AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">
                    <h5 style="margin-left: 10px;"><strong>Responsavel por aluno!</strong></h5><br>
                </div>
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Sr(a).: {{session('nome_do_resp')}}</label></h4>
                </div>    
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Aluno: {{session('resp_do_aluno')}}</label></h4>
                </div>
                @if (session('carteira'))
                <div class="row" style="background-color: #E0FFFF; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>{{session('carteira')}}</strong></h3><br>
                </div>       
                @endif
                <hr>
                <div class="row justify-content-center">
                    <img src = "{{ asset('storage/alunos/'.session('arquivo')) }}" class="img-fluid" width="200px" height="200px" alt="SEM FOTO">    
                </div>
                <hr>
        @endif


        <!--TERMINA AVISOS DE ENTRADA-->


        <!--##########################################################################################################################################-->
        <!--AVISOS de SAÍDA-->

        @if(session('sai_neg_usuario_bloqueado'))
        <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>SAÍDA NÃO AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>O status deste usuário pode estar BLOQUEADO!</label></h4>
                </div>    
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Possíveis problemas: Novo cadastro, baixa, transferência, etc.</label></h4>
                </div>
        @endif
        @if(session('sai_neg_encontrado'))
        <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>SAÍDA NÃO AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Usuário não encontrado!</label></h4>
                </div>
        @endif

        @if(session('sai_success'))
        <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>SAÍDA AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Sr(a) {{session('nome')}}</label></h4>
                </div>    
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Local: {{session('local')}}</label></h4>
                </div>       

                <hr>
                <div class="row justify-content-center">
                    <img src = "{{ asset('storage/usuarios/'.session('arquivo')) }}" class="img-fluid" width="200px" height="200px" alt="SEM FOTO">    
                </div>
                <hr>
        @endif

        @if(session('sai_success_aluno'))
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>SAÍDA AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Aluno: {{session('nome_do_aluno')}}</label></h4>
                </div>    
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Instituição: {{session('local_do_aluno')}}</label></h4>
                </div>       

                <hr>
                <div class="row justify-content-center">
                    <img src = "{{ asset('storage/alunos/'.session('arquivo')) }}" class="img-fluid" width="200px" height="200px" alt="SEM FOTO">    
                </div>
                <hr>
        @endif

        @if(session('sai_hora_neg'))
        <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>SAÍDA NÃO PERMITIDA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Aluno não morador da Vila BACG!</label></h4>
                </div>    
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Horário ou dia com bloqueio de entrada!</label></h4>
                </div>       
        @endif

        @if(session('sai_success_resp'))
        <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h3 style="margin-left: 10px;"><strong>SAÍDA AUTORIZADA!</strong></h3><br>
                </div>
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">
                    <h4 style="margin-left: 10px;"><label>Sr(a).: {{session('nome_do_resp')}}</label></h4>
                </div>    
                <div class="row" style="background-color: #EEE8AA; border-radius: 10px;">    
                    <h4 style="margin-left: 10px;"><label>Aluno: {{session('resp_do_aluno')}}</label></h4>
                </div>       

                <hr>
                <div class="row justify-content-center">
                    <img src = "{{ asset('storage/alunos/'.session('arquivo')) }}" class="img-fluid" width="200px" height="200px" alt="SEM FOTO">    
                </div>
                <hr>
        @endif


        <!--TERMINA AVISOS DE SAÍDA-->

                            <h4>Digite o CPF ou faça a leitura do QR-Code</h4>
                            <hr>
                            <form method="POST" action="{{route('qrcode_portaria')}}" id="morador">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        
                                        <div class="form-group">
                                            <label style="color: green" for="entrada">QR-Code - ENTRADA <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Leitura do QR-Code para ENTRADA de morador!"></i></label>
                                            <input class="form-control" id="entrada" name="entrada" style="color: green;" onchange="envia();" autofocus>
                                        </div>
                                    </div>
                                    <div class="col">

                                        <div class="form-group">
                                            <label style="color: red" for="saida">QR-Code - SAÍDA <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Leitura do QR-Code para SAÍDA de morador!"></i></label>
                                            <input class="form-control" id="saida" name="saida" style="color: red;" onchange="envia();">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    <div class="row justify-content-center">
    </div>

    <script>
        function envia(){
          document.querySelector('#morador').submit();  
      };
  </script>

