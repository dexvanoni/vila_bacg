@php
                function getProfileName($profile)
                {
                    switch ($profile) {
                        case 'ad':
                            return 'Administrador';
                        case 'so':
                            return 'Sócio';
                        case 'mo':
                            return 'Morador';
                        case 'fe':
                            return 'Funcionário Escola';
                        case 'ef':
                            return 'Efetivo BACG';
                        case 'ra':
                            return 'Responsável por Aluno';
                        case 'po':
                            return 'Portaria';
                        case 'in':
                            return 'Inteligência';
                        case 'al':
                            return 'Aluno';

                        // Adicione mais casos conforme necessário
                        default:
                            return 'Desconhecido';
                    }
                }
              @endphp
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

  <!--SCRIPT PARA LEITOR DE QRCODE-->
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>



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

 

  <script src="{{ asset('/js/jsQR.js') }}"></script>

  
  <style>
    @yield('style_morador')
    @yield('cad_morador')

    .alerta {
      height: 100px;
      font-size: 32px;
    }
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
    <script type="text/javascript" src="/nicedit/nicEdit.js"></script>
    @yield('onesignal')
    <body>

      <div class="page-wrapper chiller-theme toggled">
        @if(Auth::check())
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
              <!--retirado verificação direta de perfil. Colocado em AppServiceProvider a variavel $userProfiles para verificação do perfil do usuário logado em todas as views-->
              
                @foreach($userProfiles as $profile)
                    Perfil: {{ getProfileName($profile) }}<br>
                @endforeach

             @isset(Auth::user()->local)
             <br>Local de Acesso: <br><i class="fas fa-home"></i>  {{Auth::user()->local}}
             @endisset
              @isset(Auth::user()->funcao)
             <br><br>Você possui uma função no SisVila: <br><i class="fas fa-users-cog"></i>  
               @if(Auth::user()->funcao == 'in')
                Inteligência
                @elseif(Auth::user()->funcao == 'APEMEI')
                Aprovador de cadastros da EMEI
                @else
                Aprovador de cadastros da Escola
               @endif
             @endisset
             <br>
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
            <hr>
            <h6>
              <span>
                <a href="{{route('tutorial')}}"><i class="fas fa-graduation-cap"></i>Tutorial</a>
              </span>
            </h6>
            @endisset
          </span>
        </div>
      </div>
      
    @isset(Auth::user()->name)
    <div class="sidebar-menu">
      <ul>
        <li class="header-menu">
          <span>Geral</span>
        </li>
        <li>
          <a href="{{ route('home') }}">
            <i class="fa fa-tachometer-alt"></i>
            <span>Página Inicial</span>
            <span class="badge badge-pill badge-warning">New</span>
          </a>
        </li>
        @if(in_array('ad', $userProfiles) || in_array('de', $userProfiles) || in_array('pe', $userProfiles) || in_array('fe', $userProfiles))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-users"></i>
            <span class="badge badge-pill badge-warning">New</span>
            <span>Usuários</span>
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
              @if(in_array('ad', $userProfiles))
              <li>
                <a href="{{ route('select') }}">Cadastrar
                </a>
              </li>
              <li>
                <a href="{{route('usuarios.index')}}">Lista</a>
              </li>
              <li>
                <a href="{{route('escolas.index')}}">Email Funcional EMEI e Escola</a>
              </li>
              @endif
              @if(!in_array('fe', $userProfiles))
              <li>
                <a href="{{route('aluno_resp.index')}}">Alunos (EMEI e Escola)</a>
              </li>
              <li>
                <a href="{{route('aluno_resp.index_resp')}}">Responsáveis por Alunos (EMEI e Escola)</a>
              </li>
              
              @endif
              <li>
                <a href="{{route('pets.index')}}">Animais de estimação</a>
              </li>
            </ul>
          </div>
        </li>
        @endif
        @if(in_array('ad', $userProfiles) || in_array('si', $userProfiles))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-city"></i>
            <span>Locais e Edificações</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              @if(in_array('ad', $userProfiles))
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
        @if(in_array('ad', $userProfiles) || in_array('si', $userProfiles) || in_array('po', $userProfiles) || in_array('de', $userProfiles) || in_array('pe', $userProfiles))
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
              @if(in_array('ad', $userProfiles) || in_array('si', $userProfiles))
              <li>
                <a href="{{route('avisos.create')}}">Novo</a>
              </li>
              @endif
              @if(in_array('ad', $userProfiles) || in_array('si', $userProfiles) || in_array('po', $userProfiles) || in_array('de', $userProfiles) || in_array('pe', $userProfiles))
              <li>
                <a href="{{route('avisos.index')}}">Lista</a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endif
        @if(in_array('ad', $userProfiles) || in_array('po', $userProfiles) || in_array('so', $userProfiles) || in_array('mo', $userProfiles))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-newspaper"></i>
            <span class="badge badge-pill badge-warning">New</span>
            <span>Ocorrências</span>
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
              @if(in_array('ad', $userProfiles) || in_array('po', $userProfiles) || in_array('de', $userProfiles) || in_array('pe', $userProfiles) || in_array('st', $userProfiles) || in_array('fe', $userProfiles) || in_array('ps', $userProfiles))
              <li>
                <a href="{{route('ocorrencias.create')}}">Novo</a>
              </li>
              @endif
              @if(in_array('ad', $userProfiles) || in_array('si', $userProfiles) || in_array('po', $userProfiles) || in_array('de', $userProfiles) || in_array('pe', $userProfiles) || in_array('st', $userProfiles) || in_array('fe', $userProfiles) || in_array('ps', $userProfiles))
              <li>
                <a href="{{route('ocorrencias.index')}}">Lista</a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endif
        @if(in_array('ad', $userProfiles) || in_array('mo', $userProfiles))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fab fa-readme"></i>
            <span>Administrativo</span><span class="badge badge-pill badge-warning">New</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="#">Enquetes/Votações</a>
              </li>
              <li>
                <a href="{{route('docs.index')}}">Arquivos <span class="badge badge-pill badge-warning">New</span></a>
              </li>
              <li>
                <a href="#">Financeiro</a>
              </li>
            </ul>
          </div>
        </li>
        @endif
        @if(in_array('ad', $userProfiles) || in_array('pe', $userProfiles) || in_array('de', $userProfiles) || in_array('st', $userProfiles) || in_array('po', $userProfiles) || in_array('si', $userProfiles))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-hammer"></i>
            <span>Manutenção (ACVBA)</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              @if(in_array('ad', $userProfiles) || in_array('pe', $userProfiles) || in_array('de', $userProfiles) || in_array('st', $userProfiles) || in_array('fe', $userProfiles) || in_array('po', $userProfiles))
              <li>
                <a href="#">Solicitação</a>
              </li>
              @endif
              @if(in_array('ad', $userProfiles) || in_array('pe', $userProfiles) || in_array('de', $userProfiles) || in_array('st', $userProfiles) || in_array('fe', $userProfiles) || in_array('po', $userProfiles) || in_array('si', $userProfiles))
              <li>
                <a href="#">Acompanhamento</a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endif
        
        @if(in_array('ad', $userProfiles) || in_array('po', $userProfiles) || in_array('de', $userProfiles) || in_array('pe', $userProfiles) || in_array('st', $userProfiles) || in_array('sd', $userProfiles))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-swimmer"></i>
            <span>Áreas de Lazer</span>
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
        
        @if(in_array('ad', $userProfiles) || in_array('in', $userProfiles))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-user-secret"></i>
            <span>Inteligência</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              @if(in_array('in', $userProfiles))
              <li>
                <a href="#">Realizar parecer</a>
              </li>
              @endif
              @if(in_array('ad', $userProfiles) || in_array('in', $userProfiles))
              <li>
                <a href="#">Lista</a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endif
        @if(in_array('ad', $userProfiles) || in_array('de', $userProfiles) || in_array('pe', $userProfiles) || in_array('st', $userProfiles) || in_array('sd', $userProfiles))
        <li class="header-menu">
          <span>Portaria</span>
        </li>
        <li>
          <a href="{{route('liberacao.create')}}">
            <i class="fas fa-door-open"></i>
            <span>Liberar Visitante</span>
            <span class="badge badge-pill badge-warning">New</span>
          </a>
        </li>
        @endif
        @if(in_array('ad', $userProfiles) || in_array('po', $userProfiles))
        <li>
          <a href="{{route('liberacao.index')}}">
            <i class="fas fa-car"></i>
            <span>Controle Acesso</span>
            <span class="badge badge-pill badge-warning">New</span>
          </a>
        </li>
        @endif
        @if(in_array('ad', $userProfiles) || in_array('de', $userProfiles) || in_array('pe', $userProfiles) || in_array('st', $userProfiles) || in_array('sd', $userProfiles))
        <li>
          <a href="{{route('lista_ingresso.index')}}">
            <i class="fas fa-address-book"></i>
            <span>Lista de Ingresso</span>
            <span class="badge badge-pill badge-warning">New</span>
          </a>
        </li>
        @endif
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


@endif
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
      © {{Carbon\Carbon::now()->year}} by - 
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
//lente de aumento das imagens em usuarios.show
     function imageZoom(imgID, resultID) {
        var img = $("#" + imgID);
        var result = $("#" + resultID);
        var lens = $("<div class='img-zoom-lens'></div>");

        img.parent().append(lens);

        var cx = result.width() / lens.width();
        var cy = result.height() / lens.height();

        result.css("background-image", "url('" + img.attr("src") + "')");
        result.css("background-size", (img.width() * cx) + "px " + (img.height() * cy) + "px");

        lens.mousemove(moveLens);
        img.mousemove(moveLens);

        lens.on("touchmove", moveLens);
        img.on("touchmove", moveLens);

        function moveLens(e) {
            e.preventDefault();
            var pos = getCursorPos(e);
            var x = pos.x - (lens.width() / 2);
            var y = pos.y - (lens.height() / 2);

            if (x > img.width() - lens.width()) { x = img.width() - lens.width(); }
            if (x < 0) { x = 0; }
            if (y > img.height() - lens.height()) { y = img.height() - lens.height(); }
            if (y < 0) { y = 0; }

            lens.css({ left: x + "px", top: y + "px" });
            result.css("background-position", "-" + (x * cx) + "px -" + (y * cy) + "px");
            result.show();
        }

        function getCursorPos(e) {
            var a = img[0].getBoundingClientRect();
            var x = e.pageX - a.left;
            var y = e.pageY - a.top;
            x = x - $(window).scrollLeft();
            y = y - $(window).scrollTop();
            return { x: x, y: y };
        }

        img.mouseleave(function() {
            result.hide();
        });

        lens.mouseleave(function() {
            result.hide();
        });
    }

    // Inicialize a lupa para ambas as imagens
    imageZoom("foto", "foto_resultado");
    imageZoom("cnh", "cnh_resultado");
    //lente de aumento das imagens em usuarios.show

  //document.getElementById("backBtn").addEventListener("click", function(){
  //  history.back();
  //});

    $("#rg").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

    $("#rg_aluno").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

    $("#rg_resp").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

    $("#num_cnh").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

    $("#num_cnh_resp").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

    $("#cpf").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

      $("#cpf_aluno").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

      $("#cpf_resp").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

      $("#cep_aluno").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

      $("#cep_resp").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

      $("#cep_func").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

      $("#num_casa_aluno").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

      $("#num_casa_func").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

      $("#num_casa_resp").keydown(function(e) {
        // Permite backspace, tab e delete
        if (e.which === 8 || e.which === 9 || e.which === 46) {
          return;
        }

        // Permite digitação apenas de números
        if (e.which >= 48 && e.which <= 57) {
          return;
        }

        // Bloqueia outras teclas
        e.preventDefault();
      });

    $('.dropdown-toggle').dropdown();

    $('#lista_usuarios').DataTable({
      dom: 'Bfrtip',
      paging: true, // Ativar paginação
      pageLength: 15, // Número de itens por página
      ordering: true, // Ativar ordenação
      searching: true, // Ativar barra de pesquisa
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
      responsive: true,
    });

    //Se a rota for de docs
    @if(Request::routeIs('docs.*'))
    //---------------------------------------------------------------------------------------------------
    //SCRIPT PARA FAZER O SELECT EM MASSA DA TABELA docs E DELETAR

        // Selecionar todos os checkboxes quando o checkbox "Select All" é clicado
    $('#selectAll').on('change', function () {
        $('input[name="selected[]"]').prop('checked', this.checked);
    });

    $('#deleteSelected').click(function () {
        let selected = [];

        // Coleta os IDs dos checkboxes marcados
        $('input[name="selected[]"]:checked').each(function () {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Por favor, selecione pelo menos um item para deletar.');
            return; // Se não houver nada selecionado, interrompa a ação
        }

        // Exibir um alerta de confirmação
        const confirmation = confirm('Tem certeza de que deseja deletar os Documentos selecionados? Esta ação não pode ser desfeita.');

        if (confirmation) {
            // Se o usuário confirmar, execute a solicitação AJAX
            $.ajax({
                url: '/delete_massa_docs', // Endpoint para deleção
                method: 'DELETE', // Método HTTP
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para segurança
                    ids: selected // IDs dos itens selecionados
                },
                success: function (response) {
                    //console.log('Delete response:', response); // Para depuração
                    location.reload(); // Recarrega a página após a deleção
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting items:', textStatus, errorThrown); // Para depuração de erros
                }
            });
        }
    });
    //SELECT EM MASSA NA TABELA DE USUÁRIOS E DELETAR
    //---------------------------------------------------------------------------------------------------
@endif

    //Se a rota for de usuários
    @if(Request::routeIs('usuarios.*'))
    //---------------------------------------------------------------------------------------------------
    //SCRIPT PARA FAZER O SELECT EM MASSA DA TABELA USUÁRIOS E DELETAR

        // Selecionar todos os checkboxes quando o checkbox "Select All" é clicado
    $('#selectAll').on('change', function () {
        $('input[name="selected[]"]').prop('checked', this.checked);
    });

    $('#deleteSelected').click(function () {
        let selected = [];

        // Coleta os IDs dos checkboxes marcados
        $('input[name="selected[]"]:checked').each(function () {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Por favor, selecione pelo menos um item para deletar.');
            return; // Se não houver nada selecionado, interrompa a ação
        }

        // Exibir um alerta de confirmação
        const confirmation = confirm('Tem certeza de que deseja deletar os usuários selecionados? Esta ação não pode ser desfeita.');

        if (confirmation) {
            // Se o usuário confirmar, execute a solicitação AJAX
            $.ajax({
                url: '/delete_massa', // Endpoint para deleção
                method: 'DELETE', // Método HTTP
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para segurança
                    ids: selected // IDs dos itens selecionados
                },
                success: function (response) {
                    //console.log('Delete response:', response); // Para depuração
                    location.reload(); // Recarrega a página após a deleção
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting items:', textStatus, errorThrown); // Para depuração de erros
                }
            });
        }
    });
    //SELECT EM MASSA NA TABELA DE USUÁRIOS E DELETAR
    //---------------------------------------------------------------------------------------------------
@endif

//se a rota for de aluno_resp
 @if(Request::routeIs('aluno_resp.*') || Request::routeIs('aluno_resp_resp'))
    //---------------------------------------------------------------------------------------------------
    //SCRIPT PARA FAZER O SELECT EM MASSA DA TABELA alunos E DELETAR

        // Selecionar todos os checkboxes quando o checkbox "Select All" é clicado
    $('#selectAll').on('change', function () {
        $('input[name="selected[]"]').prop('checked', this.checked);
    });

    $('#deleteSelected').click(function () {
        let selected = [];

        // Coleta os IDs dos checkboxes marcados
        $('input[name="selected[]"]:checked').each(function () {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Por favor, selecione pelo menos um item para deletar.');
            return; // Se não houver nada selecionado, interrompa a ação
        }

        // Exibir um alerta de confirmação
        const confirmation = confirm('Tem certeza de que deseja deletar os alunos/responsáveis selecionados? Esta ação não pode ser desfeita.');

        if (confirmation) {
            // Se o usuário confirmar, execute a solicitação AJAX
            $.ajax({
                url: '/delete_massa_aluno', // Endpoint para deleção
                method: 'DELETE', // Método HTTP
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para segurança
                    ids: selected // IDs dos itens selecionados
                },
                success: function (response) {
                    //console.log('Delete response:', response); // Para depuração
                    location.reload(); // Recarrega a página após a deleção
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting items:', textStatus, errorThrown); // Para depuração de erros
                }
            });
        }
    });
    //SELECT EM MASSA NA TABELA DE alunos E DELETAR
    //---------------------------------------------------------------------------------------------------
@endif
@if(Request::routeIs('usuarios.*'))
    //---------------------------------------------------------------------------------------------------
    //SCRIPT PARA FAZER O SELECT EM MASSA DA TABELA USUÁRIOS E ATIVAR => status=1

        // Selecionar todos os checkboxes quando o checkbox "Select All" é clicado
    $('#selectAll').on('change', function () {
        $('input[name="selected[]"]').prop('checked', this.checked);
    });

    $('#ativaSelected').click(function () {
        let selected = [];

        // Coleta os IDs dos checkboxes marcados
        $('input[name="selected[]"]:checked').each(function () {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Por favor, selecione pelo menos um item para deletar.');
            return; // Se não houver nada selecionado, interrompa a ação
        }

        // Exibir um alerta de confirmação
        const confirmation = confirm('Tem certeza de que deseja ATIVAR os usuários selecionados?');

        if (confirmation) {
            // Se o usuário confirmar, execute a solicitação AJAX
            $.ajax({
                url: '/ativa_massa', // Endpoint para deleção
                method: 'POST', // Método HTTP
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para segurança
                    ids: selected // IDs dos itens selecionados
                },
                success: function (response) {
                    //console.log('Delete response:', response); // Para depuração
                    location.reload(); // Recarrega a página após a deleção
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting items:', textStatus, errorThrown); // Para depuração de erros
                }
            });
        }
    });
    //SELECT EM MASSA NA TABELA DE USUÁRIOS E ATIVAR => status=1
    //---------------------------------------------------------------------------------------------------
@endif

@if(Request::routeIs('aluno_resp.*') || Request::routeIs('aluno_resp_resp'))
    //---------------------------------------------------------------------------------------------------
    //SCRIPT PARA FAZER O SELECT EM MASSA DA TABELA USUÁRIOS E ATIVAR => status=1

        // Selecionar todos os checkboxes quando o checkbox "Select All" é clicado
    $('#selectAll').on('change', function () {
        $('input[name="selected[]"]').prop('checked', this.checked);
    });

    $('#ativaSelected').click(function () {
        let selected = [];

        // Coleta os IDs dos checkboxes marcados
        $('input[name="selected[]"]:checked').each(function () {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Por favor, selecione pelo menos um item para deletar.');
            return; // Se não houver nada selecionado, interrompa a ação
        }

        // Exibir um alerta de confirmação
        const confirmation = confirm('Tem certeza de que deseja ATIVAR os alunos/responsáveis selecionados?');

        if (confirmation) {
            // Se o usuário confirmar, execute a solicitação AJAX
            $.ajax({
                url: '/ativa_massa_aluno', // Endpoint para deleção
                method: 'POST', // Método HTTP
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para segurança
                    ids: selected // IDs dos itens selecionados
                },
                success: function (response) {
                    //console.log('Delete response:', response); // Para depuração
                    location.reload(); // Recarrega a página após a deleção
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting items:', textStatus, errorThrown); // Para depuração de erros
                }
            });
        }
    });
    //SELECT EM MASSA NA TABELA DE USUÁRIOS E ATIVAR => status=1
    //---------------------------------------------------------------------------------------------------
@endif

@if(Request::routeIs('usuarios.*'))
        //---------------------------------------------------------------------------------------------------
    //SCRIPT PARA FAZER O SELECT EM MASSA DA TABELA USUÁRIOS E DESATIVAR => status=0

        // Selecionar todos os checkboxes quando o checkbox "Select All" é clicado
    $('#selectAll').on('change', function () {
        $('input[name="selected[]"]').prop('checked', this.checked);
    });

    $('#desativaSelected').click(function () {
        let selected = [];

        // Coleta os IDs dos checkboxes marcados
        $('input[name="selected[]"]:checked').each(function () {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Por favor, selecione pelo menos um item para deletar.');
            return; // Se não houver nada selecionado, interrompa a ação
        }

        // Exibir um alerta de confirmação
        const confirmation = confirm('Tem certeza de que deseja DESATIVAR os usuários selecionados?');

        if (confirmation) {
            // Se o usuário confirmar, execute a solicitação AJAX
            $.ajax({
                url: '/desativa_massa', // Endpoint para deleção
                method: 'POST', // Método HTTP
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para segurança
                    ids: selected // IDs dos itens selecionados
                },
                success: function (response) {
                    //console.log('Delete response:', response); // Para depuração
                    location.reload(); // Recarrega a página após a deleção
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting items:', textStatus, errorThrown); // Para depuração de erros
                }
            });
        }
    });
    //SELECT EM MASSA NA TABELA DE USUÁRIOS E DESATIVAR => status=0
    //---------------------------------------------------------------------------------------------------
@endif

@if(Request::routeIs('aluno_resp.*') || Request::routeIs('aluno_resp_resp'))
        //---------------------------------------------------------------------------------------------------
    //SCRIPT PARA FAZER O SELECT EM MASSA DA TABELA USUÁRIOS E DESATIVAR => status=0

        // Selecionar todos os checkboxes quando o checkbox "Select All" é clicado
    $('#selectAll').on('change', function () {
        $('input[name="selected[]"]').prop('checked', this.checked);
    });

    $('#desativaSelected').click(function () {
        let selected = [];

        // Coleta os IDs dos checkboxes marcados
        $('input[name="selected[]"]:checked').each(function () {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Por favor, selecione pelo menos um item para deletar.');
            return; // Se não houver nada selecionado, interrompa a ação
        }

        // Exibir um alerta de confirmação
        const confirmation = confirm('Tem certeza de que deseja DESATIVAR os alunos/responsáveis selecionados?');

        if (confirmation) {
            // Se o usuário confirmar, execute a solicitação AJAX
            $.ajax({
                url: '/desativa_massa_aluno', // Endpoint para deleção
                method: 'POST', // Método HTTP
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para segurança
                    ids: selected // IDs dos itens selecionados
                },
                success: function (response) {
                    //console.log('Delete response:', response); // Para depuração
                    location.reload(); // Recarrega a página após a deleção
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting items:', textStatus, errorThrown); // Para depuração de erros
                }
            });
        }
    });
    //SELECT EM MASSA NA TABELA DE USUÁRIOS E DESATIVAR => status=0
    //---------------------------------------------------------------------------------------------------
@endif


    $('#lista_alunos').DataTable({
      dom: 'Bfrtip',
      paging: true, // Ativar paginação
      pageLength: 10, // Número de itens por página
      ordering: true, // Ativar ordenação
      searching: true, // Ativar barra de pesquisa
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
      responsive: true,
    });

    $('#lista_resp').DataTable({
      dom: 'Bfrtip',
      paging: true, // Ativar paginação
      pageLength: 10, // Número de itens por página
      ordering: true, // Ativar ordenação
      searching: true, // Ativar barra de pesquisa
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
      responsive: true,
    });

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

    $('input[name="condutor"]').on('change', function() {
                var opcaoSelecionada = $(this).val();
                if (opcaoSelecionada === 'sim') {
                    $('#condutor').show();
                    $('#sim_condutor').show();
                    $('#nao_condutor').hide();
                    $('#foto_cnh').show();
                } else if (opcaoSelecionada === 'nao') {
                    $('#condutor').hide();
                    $('#foto_cnh').show();
                    $('#nao_condutor').show();
                    $('#sim_condutor').hide();
                }
    });

    $('input[name="condutor_resp"]').on('change', function() {
                var opcaoSelecionada_resp = $(this).val();
                if (opcaoSelecionada_resp === 'sim') {
                    $('#condutor_resp').show();
                } else if (opcaoSelecionada_resp === 'nao') {
                    $('#condutor_resp').hide();
                }
    });
    //CONSULTA CEP

      $('#cep_aluno').on('blur', function () {
        var cep = $(this).val();

        if (cep.length == 8) {
          $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
            if (!("erro" in data)) {
              $('#rua_aluno').val(data.logradouro);
              $('#bairro_aluno').val(data.bairro);
              $('#cidade_aluno').val(data.localidade);
            } else {
              alert('CEP não encontrado.');
            }
          });
        }
      });
    $('#cep_resp').on('blur', function () {
        var cep = $(this).val();

        if (cep.length == 8) {
          $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
            if (!("erro" in data)) {
              $('#rua_resp').val(data.logradouro);
              $('#bairro_resp').val(data.bairro);
              $('#cidade_resp').val(data.localidade);
            } else {
              alert('CEP não encontrado.');
            }
          });
        }
      });
    $('#cep_func').on('blur', function () {
        var cep = $(this).val();

        if (cep.length == 8) {
          $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
            if (!("erro" in data)) {
              $('#rua_func').val(data.logradouro);
              $('#bairro_func').val(data.bairro);
              $('#cidade_func').val(data.localidade);
            } else {
              alert('CEP não encontrado.');
            }
          });
        }
      });
    
    //aparece a div de cadastro dos alunos na view REGISTER    
    $("#condutor").hide();
    $("#foto_cnh").hide();
    $("#condutor_resp").hide();
    $("#dados_alunos").hide();
    $("#divResultados").hide();
    $("#cadastro_organico").hide();
    $("#cadastro_escolas").hide();
    $("#dados_funcionario").hide();
    $("#dados_resp").hide();

    

    $('[data-toggle="tooltip"]').tooltip();

      //---------------------------------------------------------------------------------------------------
    // ==============  FORMULÁRIO DE CADASTRO DE MORADOR EM register (CADASTROS\MO.BLADE.PHP)
//---------------------------------------------------------------------------------------------------
@isset($param)
@if ($param == 'mo')
          //$('#nao_condutor').hide();   

    // Função para verificar se todos os campos obrigatórios estão preenchidos
    function verificarCampos() {
        // Obter todos os campos obrigatórios no formulário
        const camposObrigatorios = document.querySelectorAll("#registration-form [required]");

        // Verificar se todos os campos obrigatórios estão preenchidos
        const todosPreenchidos = Array.from(camposObrigatorios).every(
            (campo) => campo.value.trim() !== ""
        );

        const submitButton = document.getElementById("envia");

        // Mostrar ou esconder o botão de envio
        if (todosPreenchidos) {
            submitButton.style.display = "block";
        } else {
            submitButton.style.display = "none";
        }
    }

    // Adicionar eventos para monitorar mudanças em todos os campos obrigatórios
    const camposObrigatorios = document.querySelectorAll("#registration-form [required]");
    camposObrigatorios.forEach((campo) => {
        campo.addEventListener("input", verificarCampos);
    });

    // Verificar campos quando a página carrega
     verificarCampos();
    //---------------------------------------------------------------------------------------------------
    // MODAL DE CONFIRMAÇÃO DE ENVIO DO FORMULÁRIO
    $('#confirmationModal_morador').on('show.bs.modal', function (event) {
        var local = $('#local').val();
        var email = $('#email').val();
        var name = $('#name').val();
        var rg = $('#rg').val();
        var cpf = $('#cpf').val();
        var telefone = $('#telefone').val();
        var nascimento = $('#nascimento').val();
        var password = $('#password').val();
        var passwordConfirmation = $('#password_confirmation').val();
        var num_cnh = $('#num_cnh').val();
        var categoria_cnh = $('#categoria_cnh').val();
        var validade_cnh = $('#validade_cnh').val();

        // Extrai as partes da data
        var partes = nascimento.split("-");
        var ano = partes[0];
        var mes = partes[1];
        var dia = partes[2];

        // Formata para 'dd/mm/yy'
        var nascimentoFormatada = `${dia}/${mes}/${ano.slice(-2)}`;

        // Extrai as partes da data
        var partes_cnh = validade_cnh.split("-");
        var ano_cnh = partes_cnh[0];
        var mes_cnh = partes_cnh[1];
        var dia_cnh = partes_cnh[2];

        // Formata para 'dd/mm/yy'
        var validade_cnhFormatada = `${dia_cnh}/${mes_cnh}/${ano_cnh.slice(-2)}`;

        var condutor_select = $('input[name="condutor"]:checked');

          if (condutor_select.length > 0) {
            console.log(condutor_select.val());
            var condutor = condutor_select.val();
          }

        var arquivo = $('#arquivo')[0];
        var imagePreview = $('#confirm-image-arquivo');
        var arquivo_cnh = $('#arquivo_cnh')[0];
        var imagePreview_cnh = $('#confirm-image-arquivo-cnh');

        $('#confirm-name').text(name);
        $('#confirm-email').text(email);
        $('#confirm-local').text(local);
        $('#confirm-rg').text(rg);
        $('#confirm-cpf').text(cpf);
        $('#confirm-telefone').text(telefone);
        $('#confirm-nascimento').text(nascimentoFormatada);
        $('#confirm-password').text(password);
        $('#confirm-condutor').text(condutor);
        $('#confirm-num_cnh').text(num_cnh);
        $('#confirm-categoria_cnh').text(categoria_cnh);
        $('#confirm-validade_cnh').text(validade_cnhFormatada);

        if (condutor == 'nao') {
          $('#condutores').hide();
        } else {
          $('#condutores').show();
        }

        if (arquivo.files && arquivo.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo.files[0]);
        } else {
            imagePreview.attr('src', ''); // Remove a imagem se não houver arquivo
        }
        if (arquivo_cnh.files && arquivo_cnh.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview_cnh.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo_cnh.files[0]);
        } else {
            imagePreview_cnh.attr('src', ''); // Remove a imagem se não houver arquivo
        }
    });

    // Enviar o formulário ao confirmar
    $('#confirm-submit').click(function() {
        $('#registration-form').submit();
    });
    
@endif
@endisset
//---------------------------------------------------------------------------------------------------
    // ==============  FECHA FORMULÁRIO DE CADASTRO DE MORADOR EM register (CADASTROS\MO.BLADE.PHP)
    //---------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------
    // ==============  FORMULÁRIO DE CADASTRO DE ALUNO EM register (CADASTROS\AL.BLADE.PHP)
//---------------------------------------------------------------------------------------------------
@isset($param)
@if ($param == 'al')

//---------------------------------------------------------------------------------------------------
// Função para seleção de escola ou EMEI e apresentas as séries e grupos
const dropdown1 = document.getElementById('local_aluno');
const dropdown2 = document.getElementById('serie_aluno');

dropdown1.addEventListener('change', function() {
  const selectedOption = dropdown1.value;

  // Clear existing options in dropdown2
  dropdown2.options.length = 1;

  // Populate dropdown2 with options based on selectedOption
  if (selectedOption !== '') {
    const optionsData = {
      'EMEI Maria Josefina': ['Grupo 2', 'Grupo 3', 'Grupo 4', 'Grupo 5'],
      'ESCOLA Y-JUCA PIRAMA': ['1° Ano A', '1° Ano B', '2° Ano A', '2° Ano B', '3° Ano A', '3° Ano B', '4° Ano A', '4° Ano B','5° Ano A', '5° Ano B', '6° Ano A', '6° Ano B', '7° Ano A', '7° Ano B', '8° Ano A', '8° Ano B', '9° Ano A', '9° Ano B'],
      'c': ['Selecione a Escola ou EMEI']
    };

    const options = optionsData[selectedOption];
    for (const optionValue of options) {
      const optionElement = document.createElement('option');
      optionElement.value = optionValue;
      optionElement.textContent = optionValue;
      dropdown2.appendChild(optionElement);
    }

    // Enable dropdown2
    dropdown2.disabled = false;
  } else {
    // Disable dropdown2 if no option is selected
    dropdown2.disabled = true;
  }
});

//---------------------------------------------------------------------------------------------------
    // Função para verificar se todos os campos obrigatórios estão preenchidos
    function verificarCampos_aluno() {
        // Obter todos os campos obrigatórios no formulário
        const camposObrigatorios_aluno = document.querySelectorAll("#registration-form-aluno [required]");

        // Verificar se todos os campos obrigatórios estão preenchidos
        const todosPreenchidos_aluno = Array.from(camposObrigatorios_aluno).every(
            (campo_aluno) => campo_aluno.value.trim() !== ""
        );

        const submitButton_aluno = document.getElementById("envia_aluno");

        // Mostrar ou esconder o botão de envio
        if (todosPreenchidos_aluno) {
            submitButton_aluno.style.display = "block";
        } else {
            submitButton_aluno.style.display = "none";
        }
    }

    // Adicionar eventos para monitorar mudanças em todos os campos obrigatórios
    const camposObrigatorios_aluno = document.querySelectorAll("#registration-form-aluno [required]");
    camposObrigatorios_aluno.forEach((campo_aluno) => {
        campo_aluno.addEventListener("input", verificarCampos_aluno);
    });

    // Verificar campos quando a página carrega
     verificarCampos_aluno();
    //---------------------------------------------------------------------------------------------------
    // MODAL DE CONFIRMAÇÃO DE ENVIO DO FORMULÁRIO
    $('#confirmationModal_aluno').on('show.bs.modal', function (event) {
        var local = $('#local_aluno').val();
        var serie = $('#serie_aluno').val();
        var name = $('#nome_aluno').val();
        var rg = $('#rg_aluno').val();
        var cpf = $('#cpf_aluno').val();
        var nascimento = $('#dt_nascimento_aluno').val();
        var rua = $('#rua_aluno').val();
        var num = $('#num_casa_aluno').val();
        var bairro = $('#bairro_aluno').val();
        var cidade = $('#cidade_aluno').val();
        var cep = $('#cep_aluno').val();

        // Extrai as partes da data
        var partes = nascimento.split("-");
        var ano = partes[0];
        var mes = partes[1];
        var dia = partes[2];

        // Formata para 'dd/mm/yy'
        var nascimentoFormatada = `${dia}/${mes}/${ano.slice(-2)}`;

        var arquivo = $('#arquivo_aluno')[0];
        var imagePreview = $('#confirm-image-arquivo-aluno');

        $('#confirm-nome_aluno').text(name);
        $('#confirm-local_aluno').text(local);
        $('#confirm-serie_aluno').text(serie);
        $('#confirm-rg_aluno').text(rg);
        $('#confirm-cpf_aluno').text(cpf);
        $('#confirm-dt_nascimento_aluno').text(nascimentoFormatada);
        $('#confirm-rua_aluno').text(rua);
        $('#confirm-num_casa_aluno').text(num);
        $('#confirm-bairro_aluno').text(bairro);
        $('#confirm-cidade_aluno').text(cidade);
        $('#confirm-cep_aluno').text(cep);


        if (arquivo.files && arquivo.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo.files[0]);
        } else {
            imagePreview.attr('src', ''); // Remove a imagem se não houver arquivo
        }
    });

    // Enviar o formulário ao confirmar
    $('#confirm-submit').click(function() {
        $('#registration-form-aluno').submit();
    });
    
@endif
@endisset
    //---------------------------------------------------------------------------------------------------
    // ==============  FECHA FORMULÁRIO DE CADASTRO DE ALUNO EM register (CADASTROS\AL.BLADE.PHP)
    //---------------------------------------------------------------------------------------------------
      //---------------------------------------------------------------------------------------------------
    // ==============  FORMULÁRIO DE CADASTRO DE RESPONSÁVEL POR ALUNO EM register (CADASTROS\RA.BLADE.PHP)
//---------------------------------------------------------------------------------------------------
@isset($param)
@if ($param == 'ra')
          //$('#nao_condutor').hide();   

    // Função para verificar se todos os campos obrigatórios estão preenchidos
    function verificarCampos() {
        // Obter todos os campos obrigatórios no formulário
        const camposObrigatorios = document.querySelectorAll("#registration-form [required]");

        // Verificar se todos os campos obrigatórios estão preenchidos
        const todosPreenchidos = Array.from(camposObrigatorios).every(
            (campo) => campo.value.trim() !== ""
        );

        const submitButton = document.getElementById("envia");

        // Mostrar ou esconder o botão de envio
        if (todosPreenchidos) {
            submitButton.style.display = "block";
        } else {
            submitButton.style.display = "none";
        }
    }

    // Adicionar eventos para monitorar mudanças em todos os campos obrigatórios
    const camposObrigatorios = document.querySelectorAll("#registration-form [required]");
    camposObrigatorios.forEach((campo) => {
        campo.addEventListener("input", verificarCampos);
    });

    // Verificar campos quando a página carrega
     verificarCampos();
    //---------------------------------------------------------------------------------------------------
    // MODAL DE CONFIRMAÇÃO DE ENVIO DO FORMULÁRIO
    $('#confirmationModal_resp').on('show.bs.modal', function (event) {
        var email_resp = $('#email_resp').val();
        var nome_resp = $('#nome_resp').val();
        var rg_resp = $('#rg_resp').val();
        var cpf_resp = $('#cpf_resp').val();
        var telefone_resp = $('#telefone_resp').val();
        var num_cnh_resp = $('#num_cnh_resp').val();
        var categoria_cnh_resp = $('#categoria_cnh_resp').val();
        var validade_cnh_resp = $('#validade_cnh_resp').val();
        var rua_resp = $('#rua_resp').val();
        var num_resp = $('#num_casa_resp').val();
        var bairro_resp = $('#bairro_resp').val();
        var cidade_resp = $('#cidade_resp').val();
        var cep_resp = $('#cep_resp').val();

        // Extrai as partes da data
        var partes_cnh = validade_cnh_resp.split("-");
        var ano_cnh = partes_cnh[0];
        var mes_cnh = partes_cnh[1];
        var dia_cnh = partes_cnh[2];

        // Formata para 'dd/mm/yy'
        var validade_cnh_respFormatada = `${dia_cnh}/${mes_cnh}/${ano_cnh.slice(-2)}`;

        var condutor_select = $('input[name="condutor"]:checked');

          if (condutor_select.length > 0) {
            console.log(condutor_select.val());
            var condutor = condutor_select.val();
          }

        var arquivo_resp = $('#arquivo_resp')[0];
        var imagePreview_resp = $('#confirm-image-arquivo_resp');
        var arquivo_cnh_resp = $('#arquivo_cnh_resp')[0];
        var imagePreview_cnh_resp = $('#confirm-image-arquivo-cnh_resp');

        $('#confirm-nome_resp').text(nome_resp);
        $('#confirm-email_resp').text(email_resp);
        $('#confirm-rg_resp').text(rg_resp);
        $('#confirm-cpf_resp').text(cpf_resp);
        $('#confirm-telefone_resp').text(telefone_resp);
        $('#confirm-condutor_resp').text(condutor);
        $('#confirm-num_cnh_resp').text(num_cnh_resp);
        $('#confirm-categoria_cnh_resp').text(categoria_cnh_resp);
        $('#confirm-validade_cnh_resp').text(validade_cnh_respFormatada);
        $('#confirm-rua_resp').text(rua_resp);
        $('#confirm-num_casa_resp').text(num_resp);
        $('#confirm-bairro_resp').text(bairro_resp);
        $('#confirm-cidade_resp').text(cidade_resp);
        $('#confirm-cep_resp').text(cep_resp);

        if (condutor == 'nao') {
          $('#condutores').hide();
        } else {
          $('#condutores').show();
        }

        if (arquivo_resp.files && arquivo_resp.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview_resp.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo_resp.files[0]);
        } else {
            imagePreview_resp.attr('src', ''); // Remove a imagem se não houver arquivo
        }
        if (arquivo_cnh_resp.files && arquivo_cnh_resp.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview_cnh_resp.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo_cnh_resp.files[0]);
        } else {
            imagePreview_cnh_resp.attr('src', ''); // Remove a imagem se não houver arquivo
        }
    });

    // Enviar o formulário ao confirmar
    $('#confirm-submit').click(function() {
        $('#registration-form').submit();
    });
    
@endif
@endisset
//---------------------------------------------------------------------------------------------------
    // ==============  FECHA FORMULÁRIO DE CADASTRO DE MORADOR EM register (CADASTROS\MO.BLADE.PHP)
    //---------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------
    // ==============  FORMULÁRIO DE CADASTRO DE FUNCIONÁRIO ESCOLA EM register (CADASTROS\FE.BLADE.PHP)
//---------------------------------------------------------------------------------------------------
@isset($param)
@if ($param == 'fe')
          //$('#nao_condutor').hide();   

    // Função para verificar se todos os campos obrigatórios estão preenchidos
    function verificarCampos() {
        // Obter todos os campos obrigatórios no formulário
        const camposObrigatorios = document.querySelectorAll("#registration-form [required]");

        // Verificar se todos os campos obrigatórios estão preenchidos
        const todosPreenchidos = Array.from(camposObrigatorios).every(
            (campo) => campo.value.trim() !== ""
        );

        const submitButton = document.getElementById("envia");

        // Mostrar ou esconder o botão de envio
        if (todosPreenchidos) {
            submitButton.style.display = "block";
        } else {
            submitButton.style.display = "none";
        }
    }

    // Adicionar eventos para monitorar mudanças em todos os campos obrigatórios
    const camposObrigatorios = document.querySelectorAll("#registration-form [required]");
    camposObrigatorios.forEach((campo) => {
        campo.addEventListener("input", verificarCampos);
    });

    // Verificar campos quando a página carrega
     verificarCampos();
    //---------------------------------------------------------------------------------------------------
    // MODAL DE CONFIRMAÇÃO DE ENVIO DO FORMULÁRIO
    $('#confirmationModal_morador').on('show.bs.modal', function (event) {
        var local = $('#local').val();
        var email = $('#email').val();
        var name = $('#name').val();
        var rg = $('#rg').val();
        var cpf = $('#cpf').val();
        var telefone = $('#telefone').val();
        var nascimento = $('#nascimento').val();
        var password = $('#password').val();
        var passwordConfirmation = $('#password_confirmation').val();
        var num_cnh = $('#num_cnh').val();
        var categoria_cnh = $('#categoria_cnh').val();
        var validade_cnh = $('#validade_cnh').val();
        var rua_func = $('#rua_func').val();
        var num_func = $('#num_casa_func').val();
        var bairro_func = $('#bairro_func').val();
        var cidade_func = $('#cidade_func').val();
        var cep_func = $('#cep_func').val();

        // Extrai as partes da data
        var partes = nascimento.split("-");
        var ano = partes[0];
        var mes = partes[1];
        var dia = partes[2];

        // Formata para 'dd/mm/yy'
        var nascimentoFormatada = `${dia}/${mes}/${ano.slice(-2)}`;

        // Extrai as partes da data
        var partes_cnh = validade_cnh.split("-");
        var ano_cnh = partes_cnh[0];
        var mes_cnh = partes_cnh[1];
        var dia_cnh = partes_cnh[2];

        // Formata para 'dd/mm/yy'
        var validade_cnhFormatada = `${dia_cnh}/${mes_cnh}/${ano_cnh.slice(-2)}`;

        var condutor_select = $('input[name="condutor"]:checked');

          if (condutor_select.length > 0) {
            console.log(condutor_select.val());
            var condutor = condutor_select.val();
          }

        var arquivo = $('#arquivo')[0];
        var imagePreview = $('#confirm-image-arquivo');
        var arquivo_cnh = $('#arquivo_cnh')[0];
        var imagePreview_cnh = $('#confirm-image-arquivo-cnh');

        $('#confirm-name').text(name);
        $('#confirm-email').text(email);
        $('#confirm-local').text(local);
        $('#confirm-rg').text(rg);
        $('#confirm-cpf').text(cpf);
        $('#confirm-telefone').text(telefone);
        $('#confirm-nascimento').text(nascimentoFormatada);
        $('#confirm-password').text(password);
        $('#confirm-condutor').text(condutor);
        $('#confirm-num_cnh').text(num_cnh);
        $('#confirm-categoria_cnh').text(categoria_cnh);
        $('#confirm-validade_cnh').text(validade_cnhFormatada);
        $('#confirm-rua_func').text(rua_func);
        $('#confirm-num_casa_func').text(num_func);
        $('#confirm-bairro_func').text(bairro_func);
        $('#confirm-cidade_func').text(cidade_func);
        $('#confirm-cep_func').text(cep_func);

        if (condutor == 'nao') {
          $('#condutores').hide();
        } else {
          $('#condutores').show();
        }

        if (arquivo.files && arquivo.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo.files[0]);
        } else {
            imagePreview.attr('src', ''); // Remove a imagem se não houver arquivo
        }
        if (arquivo_cnh.files && arquivo_cnh.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview_cnh.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo_cnh.files[0]);
        } else {
            imagePreview_cnh.attr('src', ''); // Remove a imagem se não houver arquivo
        }
    });

    // Enviar o formulário ao confirmar
    $('#confirm-submit').click(function() {
        $('#registration-form').submit();
    });
    
@endif
@endisset
//---------------------------------------------------------------------------------------------------
    // ==============  FECHA FORMULÁRIO DE CADASTRO DE FUNCIONÁRIO ESCOLA EM register (CADASTROS\FE.BLADE.PHP)
    //---------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------
    // ==============  FORMULÁRIO DE CADASTRO DE PORTARIA EM register (CADASTROS\PO.BLADE.PHP)
//---------------------------------------------------------------------------------------------------
@isset($param)
@if ($param == 'po')
          //$('#nao_condutor').hide();   

    // Função para verificar se todos os campos obrigatórios estão preenchidos
    function verificarCampos() {
        // Obter todos os campos obrigatórios no formulário
        const camposObrigatorios = document.querySelectorAll("#registration-form [required]");

        // Verificar se todos os campos obrigatórios estão preenchidos
        const todosPreenchidos = Array.from(camposObrigatorios).every(
            (campo) => campo.value.trim() !== ""
        );

        const submitButton = document.getElementById("envia");

        // Mostrar ou esconder o botão de envio
        if (todosPreenchidos) {
            submitButton.style.display = "block";
        } else {
            submitButton.style.display = "none";
        }
    }

    // Adicionar eventos para monitorar mudanças em todos os campos obrigatórios
    const camposObrigatorios = document.querySelectorAll("#registration-form [required]");
    camposObrigatorios.forEach((campo) => {
        campo.addEventListener("input", verificarCampos);
    });

    // Verificar campos quando a página carrega
     verificarCampos();
    //---------------------------------------------------------------------------------------------------
    // MODAL DE CONFIRMAÇÃO DE ENVIO DO FORMULÁRIO
    $('#confirmationModal_morador').on('show.bs.modal', function (event) {
        var local = $('#local').val();
        var email = $('#email').val();
        var name = $('#name').val();
        var rg = $('#rg').val();
        var cpf = $('#cpf').val();
        var telefone = $('#telefone').val();
        var nascimento = $('#nascimento').val();
        var password = $('#password').val();
        var passwordConfirmation = $('#password_confirmation').val();
        var num_cnh = $('#num_cnh').val();
        var categoria_cnh = $('#categoria_cnh').val();
        var validade_cnh = $('#validade_cnh').val();
        var rua_func = $('#rua_func').val();
        var num_func = $('#num_casa_func').val();
        var bairro_func = $('#bairro_func').val();
        var cidade_func = $('#cidade_func').val();
        var cep_func = $('#cep_func').val();

        // Extrai as partes da data
        var partes = nascimento.split("-");
        var ano = partes[0];
        var mes = partes[1];
        var dia = partes[2];

        // Formata para 'dd/mm/yy'
        var nascimentoFormatada = `${dia}/${mes}/${ano.slice(-2)}`;

        // Extrai as partes da data
        var partes_cnh = validade_cnh.split("-");
        var ano_cnh = partes_cnh[0];
        var mes_cnh = partes_cnh[1];
        var dia_cnh = partes_cnh[2];

        // Formata para 'dd/mm/yy'
        var validade_cnhFormatada = `${dia_cnh}/${mes_cnh}/${ano_cnh.slice(-2)}`;

        var condutor_select = $('input[name="condutor"]:checked');

          if (condutor_select.length > 0) {
            console.log(condutor_select.val());
            var condutor = condutor_select.val();
          }

        var arquivo = $('#arquivo')[0];
        var imagePreview = $('#confirm-image-arquivo');
        var arquivo_cnh = $('#arquivo_cnh')[0];
        var imagePreview_cnh = $('#confirm-image-arquivo-cnh');

        $('#confirm-name').text(name);
        $('#confirm-email').text(email);
        $('#confirm-local').text(local);
        $('#confirm-rg').text(rg);
        $('#confirm-cpf').text(cpf);
        $('#confirm-telefone').text(telefone);
        $('#confirm-nascimento').text(nascimentoFormatada);
        $('#confirm-password').text(password);
        $('#confirm-condutor').text(condutor);
        $('#confirm-num_cnh').text(num_cnh);
        $('#confirm-categoria_cnh').text(categoria_cnh);
        $('#confirm-validade_cnh').text(validade_cnhFormatada);
        $('#confirm-rua_func').text(rua_func);
        $('#confirm-num_casa_func').text(num_func);
        $('#confirm-bairro_func').text(bairro_func);
        $('#confirm-cidade_func').text(cidade_func);
        $('#confirm-cep_func').text(cep_func);

        if (condutor == 'nao') {
          $('#condutores').hide();
        } else {
          $('#condutores').show();
        }

        if (arquivo.files && arquivo.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo.files[0]);
        } else {
            imagePreview.attr('src', ''); // Remove a imagem se não houver arquivo
        }
        if (arquivo_cnh.files && arquivo_cnh.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview_cnh.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo_cnh.files[0]);
        } else {
            imagePreview_cnh.attr('src', ''); // Remove a imagem se não houver arquivo
        }
    });

    // Enviar o formulário ao confirmar
    $('#confirm-submit').click(function() {
        $('#registration-form').submit();
    });
    
@endif
@endisset
//---------------------------------------------------------------------------------------------------
    // ==============  FECHA FORMULÁRIO DE CADASTRO DE PORTARIA EM register (CADASTROS\PO.BLADE.PHP)
    //---------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------
    // ==============  FORMULÁRIO DE CADASTRO DE SÓCIO EM register (CADASTROS\SO.BLADE.PHP)
//---------------------------------------------------------------------------------------------------
@isset($param)
@if ($param == 'so')
          //$('#nao_condutor').hide();   

    // Função para verificar se todos os campos obrigatórios estão preenchidos
    function verificarCampos() {
        // Obter todos os campos obrigatórios no formulário
        const camposObrigatorios = document.querySelectorAll("#registration-form [required]");

        // Verificar se todos os campos obrigatórios estão preenchidos
        const todosPreenchidos = Array.from(camposObrigatorios).every(
            (campo) => campo.value.trim() !== ""
        );

        const submitButton = document.getElementById("envia");

        // Mostrar ou esconder o botão de envio
        if (todosPreenchidos) {
            submitButton.style.display = "block";
        } else {
            submitButton.style.display = "none";
        }
    }

    // Adicionar eventos para monitorar mudanças em todos os campos obrigatórios
    const camposObrigatorios = document.querySelectorAll("#registration-form [required]");
    camposObrigatorios.forEach((campo) => {
        campo.addEventListener("input", verificarCampos);
    });

    // Verificar campos quando a página carrega
     verificarCampos();
    //---------------------------------------------------------------------------------------------------
    // MODAL DE CONFIRMAÇÃO DE ENVIO DO FORMULÁRIO
    $('#confirmationModal_morador').on('show.bs.modal', function (event) {
        var local = $('#local').val();
        var email = $('#email').val();
        var name = $('#name').val();
        var rg = $('#rg').val();
        var cpf = $('#cpf').val();
        var telefone = $('#telefone').val();
        var nascimento = $('#nascimento').val();
        var password = $('#password').val();
        var passwordConfirmation = $('#password_confirmation').val();
        var num_cnh = $('#num_cnh').val();
        var categoria_cnh = $('#categoria_cnh').val();
        var validade_cnh = $('#validade_cnh').val();
        var rua_func = $('#rua_func').val();
        var num_func = $('#num_casa_func').val();
        var bairro_func = $('#bairro_func').val();
        var cidade_func = $('#cidade_func').val();
        var cep_func = $('#cep_func').val();

        // Extrai as partes da data
        var partes = nascimento.split("-");
        var ano = partes[0];
        var mes = partes[1];
        var dia = partes[2];

        // Formata para 'dd/mm/yy'
        var nascimentoFormatada = `${dia}/${mes}/${ano.slice(-2)}`;

        // Extrai as partes da data
        var partes_cnh = validade_cnh.split("-");
        var ano_cnh = partes_cnh[0];
        var mes_cnh = partes_cnh[1];
        var dia_cnh = partes_cnh[2];

        // Formata para 'dd/mm/yy'
        var validade_cnhFormatada = `${dia_cnh}/${mes_cnh}/${ano_cnh.slice(-2)}`;

        var condutor_select = $('input[name="condutor"]:checked');

          if (condutor_select.length > 0) {
            console.log(condutor_select.val());
            var condutor = condutor_select.val();
          }

        var arquivo = $('#arquivo')[0];
        var imagePreview = $('#confirm-image-arquivo');
        var arquivo_cnh = $('#arquivo_cnh')[0];
        var imagePreview_cnh = $('#confirm-image-arquivo-cnh');

        $('#confirm-name').text(name);
        $('#confirm-email').text(email);
        $('#confirm-local').text(local);
        $('#confirm-rg').text(rg);
        $('#confirm-cpf').text(cpf);
        $('#confirm-telefone').text(telefone);
        $('#confirm-nascimento').text(nascimentoFormatada);
        $('#confirm-password').text(password);
        $('#confirm-condutor').text(condutor);
        $('#confirm-num_cnh').text(num_cnh);
        $('#confirm-categoria_cnh').text(categoria_cnh);
        $('#confirm-validade_cnh').text(validade_cnhFormatada);
        $('#confirm-rua_func').text(rua_func);
        $('#confirm-num_casa_func').text(num_func);
        $('#confirm-bairro_func').text(bairro_func);
        $('#confirm-cidade_func').text(cidade_func);
        $('#confirm-cep_func').text(cep_func);

        if (condutor == 'nao') {
          $('#condutores').hide();
        } else {
          $('#condutores').show();
        }

        if (arquivo.files && arquivo.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo.files[0]);
        } else {
            imagePreview.attr('src', ''); // Remove a imagem se não houver arquivo
        }
        if (arquivo_cnh.files && arquivo_cnh.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview_cnh.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo_cnh.files[0]);
        } else {
            imagePreview_cnh.attr('src', ''); // Remove a imagem se não houver arquivo
        }
    });

    // Enviar o formulário ao confirmar
    $('#confirm-submit').click(function() {
        $('#registration-form').submit();
    });
    
@endif
@endisset
//---------------------------------------------------------------------------------------------------
    // ==============  FECHA FORMULÁRIO DE CADASTRO DE SÓCIO EM register (CADASTROS\SO.BLADE.PHP)
    //---------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------
    // ==============  FORMULÁRIO DE CADASTRO DE EFETIVO EM register (CADASTROS\EF.BLADE.PHP)
//---------------------------------------------------------------------------------------------------
@isset($param)
@if ($param == 'ef')
          //$('#nao_condutor').hide();   

    // Função para verificar se todos os campos obrigatórios estão preenchidos
    function verificarCampos() {
        // Obter todos os campos obrigatórios no formulário
        const camposObrigatorios = document.querySelectorAll("#registration-form [required]");

        // Verificar se todos os campos obrigatórios estão preenchidos
        const todosPreenchidos = Array.from(camposObrigatorios).every(
            (campo) => campo.value.trim() !== ""
        );

        const submitButton = document.getElementById("envia");

        // Mostrar ou esconder o botão de envio
        if (todosPreenchidos) {
            submitButton.style.display = "block";
        } else {
            submitButton.style.display = "none";
        }
    }

    // Adicionar eventos para monitorar mudanças em todos os campos obrigatórios
    const camposObrigatorios = document.querySelectorAll("#registration-form [required]");
    camposObrigatorios.forEach((campo) => {
        campo.addEventListener("input", verificarCampos);
    });

    // Verificar campos quando a página carrega
     verificarCampos();
    //---------------------------------------------------------------------------------------------------
    // MODAL DE CONFIRMAÇÃO DE ENVIO DO FORMULÁRIO
    $('#confirmationModal_morador').on('show.bs.modal', function (event) {
        var local = $('#local').val();
        var email = $('#email').val();
        var name = $('#name').val();
        var rg = $('#rg').val();
        var cpf = $('#cpf').val();
        var telefone = $('#telefone').val();
        var nascimento = $('#nascimento').val();
        var password = $('#password').val();
        var passwordConfirmation = $('#password_confirmation').val();
        var num_cnh = $('#num_cnh').val();
        var categoria_cnh = $('#categoria_cnh').val();
        var validade_cnh = $('#validade_cnh').val();
        var rua_func = $('#rua_func').val();
        var num_func = $('#num_casa_func').val();
        var bairro_func = $('#bairro_func').val();
        var cidade_func = $('#cidade_func').val();
        var cep_func = $('#cep_func').val();

        // Extrai as partes da data
        var partes = nascimento.split("-");
        var ano = partes[0];
        var mes = partes[1];
        var dia = partes[2];

        // Formata para 'dd/mm/yy'
        var nascimentoFormatada = `${dia}/${mes}/${ano.slice(-2)}`;

        // Extrai as partes da data
        var partes_cnh = validade_cnh.split("-");
        var ano_cnh = partes_cnh[0];
        var mes_cnh = partes_cnh[1];
        var dia_cnh = partes_cnh[2];

        // Formata para 'dd/mm/yy'
        var validade_cnhFormatada = `${dia_cnh}/${mes_cnh}/${ano_cnh.slice(-2)}`;

        var condutor_select = $('input[name="condutor"]:checked');

          if (condutor_select.length > 0) {
            console.log(condutor_select.val());
            var condutor = condutor_select.val();
          }

        var arquivo = $('#arquivo')[0];
        var imagePreview = $('#confirm-image-arquivo');
        var arquivo_cnh = $('#arquivo_cnh')[0];
        var imagePreview_cnh = $('#confirm-image-arquivo-cnh');

        $('#confirm-name').text(name);
        $('#confirm-email').text(email);
        $('#confirm-local').text(local);
        $('#confirm-rg').text(rg);
        $('#confirm-cpf').text(cpf);
        $('#confirm-telefone').text(telefone);
        $('#confirm-nascimento').text(nascimentoFormatada);
        $('#confirm-password').text(password);
        $('#confirm-condutor').text(condutor);
        $('#confirm-num_cnh').text(num_cnh);
        $('#confirm-categoria_cnh').text(categoria_cnh);
        $('#confirm-validade_cnh').text(validade_cnhFormatada);
        $('#confirm-rua_func').text(rua_func);
        $('#confirm-num_casa_func').text(num_func);
        $('#confirm-bairro_func').text(bairro_func);
        $('#confirm-cidade_func').text(cidade_func);
        $('#confirm-cep_func').text(cep_func);

        if (condutor == 'nao') {
          $('#condutores').hide();
        } else {
          $('#condutores').show();
        }

        if (arquivo.files && arquivo.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo.files[0]);
        } else {
            imagePreview.attr('src', ''); // Remove a imagem se não houver arquivo
        }
        if (arquivo_cnh.files && arquivo_cnh.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview_cnh.attr('src', e.target.result);
            };

            reader.readAsDataURL(arquivo_cnh.files[0]);
        } else {
            imagePreview_cnh.attr('src', ''); // Remove a imagem se não houver arquivo
        }
    });

    // Enviar o formulário ao confirmar
    $('#confirm-submit').click(function() {
        $('#registration-form').submit();
    });
    
@endif
@endisset
//---------------------------------------------------------------------------------------------------
    // ==============  FECHA FORMULÁRIO DE CADASTRO DE EFETIVO EM register (CADASTROS\EF.BLADE.PHP)
    //---------------------------------------------------------------------------------------------------
  });

  // TERMINA READY
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>


<!--script de inicialização-->

@yield('script_adicional')

<!--Fim script de inicialização-->

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