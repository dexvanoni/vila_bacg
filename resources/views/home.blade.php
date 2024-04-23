<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  <link rel="stylesheet" href="{{URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css')}}" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.2/css/rowReorder.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>  
  <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>
  <link href="{{ asset('https://use.fontawesome.com/releases/v5.15.4/css/all.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
  

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'SisVILA') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('/js/app.js') }}" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/mark.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.js"></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->

  <!--<link href="{{ asset('/css/app.css') }}" rel="stylesheet">-->

  <!--DATATABLES-->
  @yield('datatables')
  <!--FIM DATATABLES-->
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

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
        appId: "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
        safari_web_id: "web.onesignal.auto.3437296f-1581-4c9c-99a7-ef947df2b18c",
        notifyButton: {
          enable: true,
        },
              //subdomainName: "sisvila1004",
              //allowLocalhostAsSecureOrigin: true,

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
  <style type="text/css">
    .jumbotron-with-background {
      background-image: url("../imagens/back2.jpg");
      background-position:center;
      background-repeat: no-repeat;
      background-size: cover;
      color: black;
      height: 200px;
      font-size:15px;
      filter: opacity(70%);
    }
    .btn-sq-lg {
      width: 150px !important;
      height: 150px !important;
    }

    .btn-sq {
      width: 100px !important;
      height: 100px !important;
      font-size: 10px;
    }

    .btn-sq-sm {
      width: 80px !important;
      height: 80px !important;
      font-size: 11px;
      text-align: center;
      vertical-align: middle;
      padding-top: 19px;
    }
    .pq {
      width: 80px !important;
      height: 80px !important;
      font-size: 11px;
      text-align: center;
      vertical-align: middle;
      padding-top: 19px;
    }
    .visitante {
      width: 80px !important;
      height: 80px !important;
      font-size: 11px;
      text-align: center;
      vertical-align: middle;
      padding-top: 19px;
    }

    .visitante2 {
      width: 3310px !important;
      height: 80px !important;
      font-size: 11px;
      text-align: center;
      vertical-align: middle;
      padding-top: 19px;
    }

    .qrcode {
      width: 106.6px !important;
      height: auto !important;
      font-size: 11px;
      text-align: center;
      vertical-align: middle;
      padding-top: 19px;
    }

    .btn-sq-xs {
      width: 25px !important;
      height: 25px !important;
      padding:2px;
    }

  </style>
  <body>

    <div class="jumbotron jumbotron-fluid jumbotron-with-background">
      <div class="container">
        <h3>SisVila - Base Aérea de Campo Grande</h3>
        <!--<a href="{{route('leitor')}}">Leitor QRCODE</a>-->
      </div>
    </div>

    <div class="container">
      @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      <hr>
      @endif
      @if (Auth::user()->autorizacao == 'ad')
        <!--Se usuário logado for Adminstrador-->
        @include('perfis.ad')
      @endif
      @if (Auth::user()->autorizacao == 'mo')
        <!--Se usuário logado for Morador-->
        @include('perfis.mo')
      @endif
      @if (Auth::user()->autorizacao == 'po')
        <!--Se usuário logado for Portaria-->
        @include('perfis.po')
      @endif
      @if (Auth::user()->autorizacao == 'ra')
        <!--Se usuário logado for Responsável por aluno-->
        @include('perfis.ra')
      @endif
      @if (Auth::user()->autorizacao == 'fe')
        <!--Se usuário logado for Funcionário da Escola-->
        @include('perfis.fe')
      @endif
      @if (Auth::user()->autorizacao == 'so')
        <!--Se usuário logado for Sócio-->
        @include('perfis.so')
      @endif
      @if (Auth::user()->autorizacao == 'ef')
        <!--Se usuário logado for Efetivo BACG-->
        @include('perfis.ef')
      @endif

@if (Auth::user()->autorizacao == 'ad' || Auth::user()->autorizacao == 'mo' || Auth::user()->autorizacao == 'po' || Auth::user()->autorizacao == 'so')
      @foreach($avisos as $a)
      <div class="row">
        <div class="col-lg-12 align-self-center d-flex justify-content-center text-center">
          <div class="card text-black <?php if ($a->prioridade == 'Alta') {
           echo 'border-danger';
         }elseif ($a->prioridade == 'Baixa') {
          echo 'border-success';
        }elseif ($a->prioridade == 'Média') {
          echo 'border-warning';
        }?> mb-3" style="width: 20rem;">
        <div class="card-header">Aviso nº: {{$a->id}}
          @if($a->dono == Auth::user()->name || Auth::user()->autorizacao == 'ad')
          <a title="Excluir" href="{{ route('avisos.delete', [$a->id]) }}">
            <i class="fas fa-trash-alt" style="color: red; margin-left: 10rem;"></i>
          </a>
          @else

          @endif
        </div>                            
        <div class="card-body">
          <h5 class="card-title">{{$a->titulo}}</h5>
          <div class="card-text">
            <a title="Ver mensagem" href="#" data-toggle="modal" data-target="#ModalView-<?php echo $a->id; ?>">
              Ver a mensagem ...
            </a>
          </div>
        </div>
      </div>


      <!--MODAL QUE EXIBE O AVISO-->
      <div class="modal fade" id="ModalView-<?=$a->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>{{$a->titulo}}</strong></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! $a->mensagem !!}
              <hr>
              <h6><strong>Data da publicação:</strong> {{date('d/m/Y', strtotime($a->created_at))}}</h6>
              <h6><strong>Prioridade:</strong> {{$a->prioridade}}</h6>
              <h6><strong>Destinatário:</strong> {{$a->a_quem}}</h6>
              <h6><strong>Duração do aviso:</strong> {{$a->duracao}} dias - ( {{Carbon\Carbon::parse($a->created_at)->addDays($a->duracao)->format('d/m/Y')}} )</h6>
              <h6><strong>Publicado por:</strong> {{$a->dono}}</h6>
              @if($a->arquivo <> 'noimage.png')
              <a title="Baixar arquivo" href="{{ route('avisos.download', ['aviso' => $a->id]) }}">
                Baixar arquivo
              </a>
              @else

              @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
      <!--FIM DO MODAL-->


    </div>
  </div>
  @endforeach
@endif

</div>

<!-- page-content" -->

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"  defer></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('#listas').DataTable();
    //$('#lista_listas').DataTable();
    $('#lista_listas').DataTable( {
      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      responsive: true
    } );
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

<!--script de inicialização-->

@yield('script_adicional')

<!--Fim script de inicialização-->
</body>
</html>
