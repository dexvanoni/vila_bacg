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
#reader_entrada {
            display: none; /* Esconde a div inicialmente */
        }

#reader_saida {
            display: none; /* Esconde a div inicialmente */
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
                                            <label style="color: green" for="entrada">QR-Code - ENTRADA</label>
                                            
                                            <div class="input-group">
                                                <input class="form-control" id="entrada" name="entrada" style="color: green;" onchange="envia()" autofocus>
                                                <div class="input-group-append">
                                                  <button style="color: green;" title="Clique aqui para abrir a câmera" id="start-scan_entrada" class="btn btn-outline-secondary" type="button"><i class="fas fa-qrcode"></i></button>
                                                </div>
                                            </div>
                                            <div id="reader_entrada" style="width: 200px; height: 200px; margin-top: 2px;"></div>

                                        </div>
                                    </div>
                                    <div class="col">

                                        <div class="form-group">
                                            <label style="color: red" for="saida">QR-Code - SAÍDA </label>

                                            <div class="input-group">
                                                <input class="form-control" id="saida" name="saida" style="color: green;" onchange="envia()" autofocus>
                                                <div class="input-group-append">
                                                  <button style="color: red;" title="Clique aqui para abrir a câmera" id="start-scan_saida" class="btn btn-outline-secondary" type="button"><i class="fas fa-qrcode"></i></button>
                                                </div>
                                            </div>
                                            
                                            <div id="reader_saida" style="width: 200px; height: 200px; margin-top: 2px;"></div>
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

      //leitor do qurcode da ENTRADA

      document.getElementById('start-scan_entrada').addEventListener('click', function() {
        const qrCodeReader = new Html5Qrcode("reader_entrada");
        const readerElement_entrada = document.getElementById('reader_entrada');

        qrCodeReader.start(
            { facingMode: "environment" }, // Configuração da câmera
            {
                fps: 10,    // Frames por segundo
                qrbox: 250  // Tamanho da caixa de QR Code (quadrado)
            },
            qrCodeMessage => {
                // O QR Code foi lido com sucesso
                document.getElementById('entrada').value = qrCodeMessage;
                qrCodeReader.stop();  // Para a câmera após leitura
                envia();
                readerElement_entrada.style.display = 'none';
            },
            errorMessage => {
                // Lida com erros ou leituras não válidas
                console.log(`QR Code no detectado. Error: ${errorMessage}`);
            })
        .catch(err => {
            // Lida com erros ao iniciar a câmera
            console.log(`Erro ao iniciar a câmera. Error: ${err}`);
        });
        readerElement_entrada.style.display = 'block';
    });

      //leitor do qurcode da SAÍDA

      document.getElementById('start-scan_saida').addEventListener('click', function() {
        const qrCodeReader = new Html5Qrcode("reader_saida");
        const readerElement_saida = document.getElementById('reader_saida');

        qrCodeReader.start(
            { facingMode: "environment" }, // Configuração da câmera
            {
                fps: 10,    // Frames por segundo
                qrbox: 250  // Tamanho da caixa de QR Code (quadrado)
            },
            qrCodeMessage => {
                // O QR Code foi lido com sucesso
                document.getElementById('saida').value = qrCodeMessage;
                qrCodeReader.stop();  // Para a câmera após leitura
                envia();
                readerElement_saida.style.display = 'none';
            },
            errorMessage => {
                // Lida com erros ou leituras não válidas
                console.log(`QR Code no detectado. Error: ${errorMessage}`);
            })
        .catch(err => {
            // Lida com erros ao iniciar a câmera
            console.log(`Erro ao iniciar a câmera. Error: ${err}`);
        });
        readerElement_saida.style.display = 'block';
    });
  </script>

