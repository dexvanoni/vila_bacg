@extends('layouts.app')
@section('onesignal')
<!--SCRIPT DE NOTIFICAÇÃO DO ONESIGNAL-->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
      window.OneSignal = window.OneSignal || [];
      OneSignal.push(function() {
        //aqui vai o código direto em cada página
        let externalUserId = "<?php print Auth::user()->id; ?>";

        OneSignal.push(function() {
          OneSignal.setExternalUserId(externalUserId);
        });
        
            OneSignal.init({
              appId: "055f1abb-5ee1-443c-8cdd-d3e5879c986a",
              safari_web_id: "web.onesignal.auto.5ecc7e9f-2540-4c26-bcd6-80ea5ac40604",
              notifyButton: {
                enable: true,
              },
              subdomainName: "sisvila1004",
              allowLocalhostAsSecureOrigin: true,

          /*
    //CÓDIGO PARA NOTIFICAÇÃO LOCALHOST
          appId: "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
          safari_web_id: "web.onesignal.auto.3437296f-1581-4c9c-99a7-ef947df2b18c",
          notifyButton: {
            enable: true,
          },
          subdomainName: "sisvila",
         allowLocalhostAsSecureOrigin: true,
         */
        });
      });
    </script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <img src="imagens/sisvila2.png" width="300px" height="250px">    
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
