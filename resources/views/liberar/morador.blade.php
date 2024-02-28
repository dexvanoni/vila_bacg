@extends('layouts.app')

@section('content')
<div class="container">

@if(session('success'))
        <div class="alert alert-success alerta" role="alert">
            {{ session('success') }}
        </div>
        <hr>
@endif
@if(session('neg'))
        <div class="alert alert-danger alerta" role="alert">
            {{ session('neg') }}
        </div>
        <hr>
@endif
@if(session('saida'))
        <div class="alert alert-warning alerta" role="alert">
            {{ session('saida') }}
        </div>
        <hr>
@endif

@if(session('success'))
<div class="row justify-content-center">
    <img src = "{{ asset('storage/usuarios/'.session('arquivo')) }}" class="img-fluid" style="max-width: 30%;" alt="SEM FOTO">    
</div>
<hr>
@endif
@if(session('saida'))
<div class="row justify-content-center">
    <img src = "{{ asset('storage/usuarios/'.session('arquivo')) }}" class="img-fluid" style="max-width: 30%;" alt="SEM FOTO">    
</div>
<hr>
@endif

<!-- FORMULÁRIO DOS LEITORES DE QR-CODE DE ENTRADA E SAÍDA DE MORADORES-->
    <form method="POST" action="{{route('qrcode_portaria')}}" id="morador">
        @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label style="color: green" for="entrada">QR-Code - ENTRADA <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Leitura do QR-Code para ENTRADA de morador!"></i></label>
                <input class="form-control" id="entrada" name="entrada" style="color: green;" onchange="envia();" autofocus>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label style="color: red" for="saida">QR-Code - SAÍDA <i class="fas fa-comment" data-toggle="tooltip" data-placement="right" title="Leitura do QR-Code para SAÍDA de morador!"></i></label>
                <input class="form-control" id="saida" name="saida" style="color: red;">
            </div>
        </div>
    </div>
    </form>

</div>

<script>
        function envia(){
          document.querySelector('#morador').submit();  
      };
    /*var entrada = document.querySelector('#entrada');
          entrada.addEventListener('change', function (e) {
            //entrada();
            //entradaApi();
            // Envie o formulário
            document.querySelector('#morador').submit();
        });

        var saida = document.querySelector('#saida');
          saida.addEventListener('change', function (e) {
            //saida();
            //saidaApi();
            // Envie o formulário
            document.querySelector('#morador').submit();      
        });*/

</script>

