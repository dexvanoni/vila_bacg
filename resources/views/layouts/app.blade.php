<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
    <link rel="stylesheet" href="{{URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css')}}" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.3/b-2.3.5/b-colvis-2.3.5/b-html5-2.3.5/b-print-2.3.5/datatables.min.css" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
      <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css">-->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.2/css/rowReorder.bootstrap4.min.css">
      <!---<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.2/css/rowReorder.dataTables.min.css">-->
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
    <script type="text/javascript">
      jQuery(function ($) {
        //ao clicar em qualquer parte do sidebar ela some.
          $(".page-wrapper").removeClass("toggled");
        // -----------------------------------------------------

          $(".sidebar-dropdown > a").click(function() {
          $(".sidebar-submenu").slideUp(200);
        if (
          $(this)
            .parent()
            .hasClass("active")
        ) {
          $(".sidebar-dropdown").removeClass("active");
          $(this)
            .parent()
            .removeClass("active");
        } else {
          $(".sidebar-dropdown").removeClass("active");
          $(this)
            .next(".sidebar-submenu")
            .slideDown(200);
          $(this)
            .parent()
            .addClass("active");
        }
      });

      $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
      });
      $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
      });   
      });
    </script>
    <style>
        mark.a0 {
            color: black;
            padding: 5px;
            background: greenyellow;
        }
  
        mark.a1 {
            color: black;
            padding: 5px;
            background: cyan;
        }
  
        mark.a2 {
            color: black;
            padding: 5px;
            background: red;
        }
  
        mark.a3 {
            color: white;
            padding: 5px;
            background: green;
        }
  
        mark.a4 {
            color: black;
            padding: 5px;
            background: pink;
        }
         @media print and (color) {
        @page {
          margin: 5mm;
          size: A4 portrait;
        }

        .printable {
          display: none;
        }
/* print styles*/
@media print {
    .printable {
        display: block;
    }
    .screen {
        display: none;
    }
}
 
    
    </style>
    <!--DATATABLES-->
      @yield('datatables')
    <!--FIM DATATABLES-->
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    @yield('onesignal')
<body>

<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="{{ route('home') }}">SisVILA - BACG</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <!--<div class="user-pic">
          <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
            alt="User picture">
        </div>-->
        <div class="user-info">
          <span class="user-name">
            @isset(Auth::user()->name)
              {{ Auth::user()->name }}
            @endisset
          </span>
          <span class="user-role">
            @isset(Auth::user()->autorizacao)
            <?php
            $perfis = collect([]);
              foreach(explode(',',  Auth::user()->autorizacao) as $info){
                if ($info == 'pe') {
                  $perfis->push('Permission??rio');
                } elseif ($info == 'de') {
                  $perfis->push('Dependente');
                } elseif ($info == 'st') {
                  $perfis->push('S??cio-Titular');
                } elseif ($info == 'sd') {
                  $perfis->push('S??cio-Dependente');
                } elseif ($info == 'fe') {
                  $perfis->push('Funcion??rio da Escola');
                } elseif ($info == 'ra') {
                  $perfis->push('Respons??vel por Aluno');
                } elseif ($info == 'ps') {
                  $perfis->push('Prestador de Servi??o');
                } elseif ($info == 'po') {
                  $perfis->push('Portaria');
                } elseif ($info == 'si') {
                  $perfis->push('S??ndico');
                } elseif ($info == 'ad') {
                  $perfis->push('Administrador');
                }
                $perfis->all();
              }
            ?>
            @foreach($perfis as $p)
              {{$p}}<br><br>
            @endforeach
            @if(!$perfis->contains('Portaria'))
              <a title="QR-Code" href="{{ route('qrcode_organico', [Auth::user()->id]) }}">
               <i class="fas fa-qrcode"></i> Meu QR-Code
              </a>
              <br>
            @endif
            @isset(Auth::user()->local)
              Local de Acesso: {{Auth::user()->local}}
            @endisset
            <br>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>

            @else
            <h6>Realize o login!</h6>
            <span class="user-status">
              <i class="fa fa-circle" style="color: red ;"></i>
              <span>Offline</span>
            </span>

            @endisset
          </span>
          
        </div>
      </div>
      <!-- sidebar-header  -->
      <!--
      @isset(Auth::user()->name)
      <div class="sidebar-search">
        <div>
          <div class="input-group">
            <input type="text" class="form-control search-menu" placeholder="Search...">
            <div class="input-group-append">
              <span class="input-group-text">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    -->
      @endisset
      <!-- sidebar-search  -->
      @isset(Auth::user()->name)
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Geral</span>
          </li>
          <li>
            <a href="{{ route('home') }}">
              <i class="fa fa-tachometer-alt"></i>
              <span>Dashboard</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
          </li>
          @if($perfis->contains('Administrador') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio'))
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-users"></i>
              <span class="badge badge-pill badge-warning">New</span>
              <span>Usu??rios</span>
              <span class="badge badge-pill badge-danger">
                <?php
                  $conta = App\User::all();
                  $c = $conta->count();
                ?>
                {{$c}}
              </span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                @if($perfis->contains('Administrador'))
                  <li>
                    <a href="{{ route('register') }}">Cadastrar
                    </a>
                  </li>
                <li>
                  <a href="{{route('usuarios.index')}}">Lista</a>
                </li>
                @endif
                <li>
                  <a href="{{route('pets.index')}}">Animais de estima????o</a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          @if($perfis->contains('Administrador') || $perfis->contains('S??ndico'))
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-city"></i>
              <span>Locais e Edifica????es</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                @if($perfis->contains('Administrador'))
                <li>
                  <a href="{{route('locais.create')}}">Adicionar</a>
                </li>
                @endif
                <li>
                  <a href="{{route('locais.index')}}">Lista</a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          @if($perfis->contains('Administrador') || $perfis->contains('S??ndico') || $perfis->contains('Portaria') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio'))
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-newspaper"></i>
              <span class="badge badge-pill badge-warning">New</span>
              <span>Avisos</span>
              <span class="badge badge-pill badge-danger">
                <?php
                  $n_avisos = App\Aviso::all();
                  $c = $n_avisos->count();
                ?>
                {{$c}}
              </span>

            </a>
            <div class="sidebar-submenu">
              <ul>
                @if($perfis->contains('Administrador') || $perfis->contains('S??ndico'))
                <li>
                  <a href="{{route('avisos.create')}}">Novo</a>
                </li>
                @endif
                @if($perfis->contains('Administrador') || $perfis->contains('S??ndico') || $perfis->contains('Portaria') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio'))
                <li>
                  <a href="{{route('avisos.index')}}">Lista</a>
                </li>
                @endif
              </ul>
            </div>
          </li>
          @endif
          @if($perfis->contains('Administrador') || $perfis->contains('S??ndico') || $perfis->contains('Portaria') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio') || $perfis->contains('S??cio-Titular') || $perfis->contains('Funcion??rio da Escola') || $perfis->contains('Prestador de Servi??o'))
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-newspaper"></i>
              <span class="badge badge-pill badge-warning">New</span>
              <span>Ocorr??ncias</span>
              <span class="badge badge-pill badge-danger">
                <?php
                  $n_ocorrencias = App\Ocorrencia::all();
                  $o = $n_ocorrencias->count();
                ?>
                {{$o}}
              </span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio') || $perfis->contains('S??cio-Titular') || $perfis->contains('Funcion??rio da Escola') || $perfis->contains('Prestador de Servi??o'))
                <li>
                  <a href="{{route('ocorrencias.create')}}">Novo</a>
                </li>
                @endif
                @if($perfis->contains('Administrador') || $perfis->contains('S??ndico') || $perfis->contains('Portaria') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio') || $perfis->contains('S??cio-Titular') || $perfis->contains('Funcion??rio da Escola') || $perfis->contains('Prestador de Servi??o'))
                <li>
                  <a href="{{route('ocorrencias.index')}}">Lista</a>
                </li>
                @endif
              </ul>
            </div>
          </li>
          @endif
          @if($perfis->contains('Administrador') || $perfis->contains('Permission??rio') || $perfis->contains('Dependente') || $perfis->contains('S??cio-Titular') || $perfis->contains('Funcion??rio da Escola') || $perfis->contains('Portaria') || $perfis->contains('S??ndico'))
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-hammer"></i>
              <span>Manuten????o (ACVBA)</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                @if($perfis->contains('Administrador') || $perfis->contains('Permission??rio') || $perfis->contains('Dependente') || $perfis->contains('S??cio-Titular') || $perfis->contains('Funcion??rio da Escola') || $perfis->contains('Portaria'))
                  <li>
                    <a href="#">Solicita????o</a>
                  </li>
                @endif
                @if($perfis->contains('Administrador') || $perfis->contains('Permission??rio') || $perfis->contains('Dependente') || $perfis->contains('S??cio-Titular') || $perfis->contains('Funcion??rio da Escola') || $perfis->contains('Portaria') || $perfis->contains('S??ndico'))
                  <li>
                    <a href="#">Acompanhamento</a>
                  </li>
                @endif
              </ul>
            </div>
          </li>
          @endif
          @if($perfis->contains('Administrador') || $perfis->contains('Permission??rio') || $perfis->contains('S??ndico'))
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-wrench"></i>
              <span>Manuten????o (PACG)</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                @if($perfis->contains('Administrador') || $perfis->contains('Permission??rio'))
                  <li>
                    <a href="#">Solicita????o</a>
                  </li>
                @endif
                @if($perfis->contains('Administrador') || $perfis->contains('Permission??rio') || $perfis->contains('S??ndico'))
                  <li>
                    <a href="#">Acompanhamento</a>
                  </li>
                @endif
              </ul>
            </div>
          </li>
          @endif
          @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio') || $perfis->contains('S??cio-Titular') || $perfis->contains('S??cio-Dependente'))
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-swimmer"></i>
              <span>??reas de Lazer</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                  <li>
                    <a href="#">ALOF</a>
                  </li>
                  <li>
                    <a href="#">ALSS</a>
                  </li>
                  <li>
                    <a href="#">ALCTS</a>
                  </li>
              </ul>
            </div>
          </li>
          @endif
          @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio') || $perfis->contains('S??cio-Titular') || $perfis->contains('S??cio-Dependente'))
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fab fa-readme"></i>
              <span>Administrativo</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                  <li>
                    <a href="#">Enquetes/Vota????es</a>
                  </li>
                  <li>
                    <a href="#">Arquivos</a>
                  </li>
                  <li>
                    <a href="#">Financeiro</a>
                  </li>
              </ul>
            </div>
          </li>
          @endif
          <li class="header-menu">
            <span>Portaria</span>
          </li>
          @if($perfis->contains('Administrador') || $perfis->contains('Dependente') || $perfis->contains('Permission??rio') || $perfis->contains('S??cio-Titular') || $perfis->contains('S??cio-Dependente'))
          <li>
            <a href="{{route('liberacao.create')}}">
              <i class="fas fa-door-open"></i>
              <span>Liberar Visitante</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
          </li>
          @endif
         @if($perfis->contains('Administrador') || $perfis->contains('Portaria'))
          <li>
            <a href="{{route('liberacao.index')}}">
              <i class="fas fa-car"></i>
              <span>Controle Acesso</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
          </li>
          @endif
          <li>
            <a href="{{route('lista_ingresso.index')}}">
              <i class="fas fa-address-book"></i>
              <span>Lista de Ingresso</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
          </li>
        </ul>
      </div>
      @endisset
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    @isset(Auth::user()->name)
    <div class="sidebar-footer">
      <a href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-warning notification">3</span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a>
      <a href="#">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a>
      <a href="{{ route('sair') }}">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
    @endisset
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
   <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

      <footer class="text-center">
        <div class="mb-2">
          <small>
            ?? {{Carbon\Carbon::now()->year}} by - 
              DeX Development|SYS
            </a>
          </small>
        </div>
      </footer>
    </div>
  </main>
  <!-- page-content" -->
</div>

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"  defer></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  
    $('#listas').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true
    });

    $('#lista_listas').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
    $('#botao').hide();
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>


  <!--script de inicializa????o-->

    @yield('script_adicional')

  <!--Fim script de inicializa????o-->

<script type="text/javascript">
  const handlePhone = (event) => {
      let input = event.target
      input.value = phoneMask(input.value)
    }

    const phoneMask = (value) => {
      if (!value) return ""
      value = value.replace(/\D/g,'')
      value = value.replace(/(\d{2})(\d)/,"($1) $2")
      value = value.replace(/(\d)(\d{4})$/,"$1-$2")
      return value
    }

    function myFunction() {      
        if($('#password').val() == $('#password_confirm').val()){
            $('.result').html('OK. Senhas iguais!');
            $('#botao').show();
            $('.result').css('background-color', 'green');
        }else{
            $('.result').html('Digite exatamente a senha escolhida!');
            $('#botao').hide();
            $('.result').css('background-color', 'red');
        }};
</script>

</body>
</html>
