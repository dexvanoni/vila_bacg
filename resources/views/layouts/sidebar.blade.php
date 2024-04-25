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
                if ($info == 'mo') {
                  $perfis->push('Morador');
                } elseif ($info == 'so') {
                  $perfis->push('Sócio');
                } elseif ($info == 'ef') {
                  $perfis->push('Efetivo BACG');
                } elseif ($info == 'fe') {
                  $perfis->push('Funcionário da Escola');
                } elseif ($info == 'ra') {
                  $perfis->push('Responsável por Aluno');
                } elseif ($info == 'po') {
                  $perfis->push('Portaria');
                } elseif ($info == 'ad') {
                  $perfis->push('Administrador');
                } elseif ($info == 'al') {
                  $perfis->push('Aluno');
                }
                $perfis->all();
              }
              ?>
              @foreach($perfis as $p)
              {{$p}}<br><br>
              @endforeach
              @if(!$perfis->contains('Portaria'))
              <!--<a title="QR-Code" href="{{ route('qrcode_organico', [Auth::user()->id]) }}">
               <i class="fas fa-qrcode"></i> Meu QR-Code
             </a>-->
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
            <span>Página Inicial</span>
            <span class="badge badge-pill badge-warning">New</span>
          </a>
        </li>
        @if($perfis->contains('Administrador') || $perfis->contains('Morador'))
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
                <a href="{{route('pets.index')}}">Animais de estimação</a>
              </li>
              <li>
                <a href="{{route('aluno_resp.index')}}">Alunos e Responsáveis (EMEI e Escola)</a>
              </li>
            </ul>
          </div>
        </li>
        @endif
        @if($perfis->contains('Administrador'))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-city"></i>
            <span>Locais e Edificações</span>
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
        @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Morador'))
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
              @if($perfis->contains('Administrador'))
              <li>
                <a href="{{route('avisos.create')}}">Novo</a>
              </li>
              @endif
              @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Morador'))
              <li>
                <a href="{{route('avisos.index')}}">Lista</a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endif
        @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Morador') || $perfis->contains('Sócio') || $perfis->contains('Funcionário da Escola') )
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
              @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Morador') || $perfis->contains('Sócio') || $perfis->contains('Funcionário da Escola'))
              <li>
                <a href="{{route('ocorrencias.create')}}">Novo</a>
              </li>
              @endif
              @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Morador') || $perfis->contains('Sócio') || $perfis->contains('Funcionário da Escola'))
              <li>
                <a href="{{route('ocorrencias.index')}}">Lista</a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endif
        @if($perfis->contains('Administrador') || $perfis->contains('Morador') || $perfis->contains('Sócio') || $perfis->contains('Funcionário da Escola') || $perfis->contains('Portaria'))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-hammer"></i>
            <span>Manutenção (ACVBA)</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              @if($perfis->contains('Administrador') || $perfis->contains('Morador')|| $perfis->contains('Sócio') || $perfis->contains('Funcionário da Escola') || $perfis->contains('Portaria'))
              <li>
                <a href="#">Solicitação</a>
              </li>
              @endif
              @if($perfis->contains('Administrador') || $perfis->contains('Morador') || $perfis->contains('Sócio') || $perfis->contains('Funcionário da Escola') || $perfis->contains('Portaria'))
              <li>
                <a href="#">Acompanhamento</a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endif
        @if($perfis->contains('Administrador') || $perfis->contains('Morador'))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fas fa-wrench"></i>
            <span>Manutenção (PACG)</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              @if($perfis->contains('Administrador') || $perfis->contains('Morador'))
              <li>
                <a href="#">Solicitação</a>
              </li>
              @endif
              @if($perfis->contains('Administrador') || $perfis->contains('Morador'))
              <li>
                <a href="#">Acompanhamento</a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endif
        @if($perfis->contains('Administrador') || $perfis->contains('Portaria') || $perfis->contains('Morador') || $perfis->contains('Sócio'))
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
        @if($perfis->contains('Administrador') || $perfis->contains('Portaria')|| $perfis->contains('Morador') || $perfis->contains('Sócio'))
        <li class="sidebar-dropdown">
          <a href="#">
            <i class="fab fa-readme"></i>
            <span>Administrativo</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="#">Enquetes/Votações</a>
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
        @if($perfis->contains('Administrador') || $perfis->contains('Morador') || $perfis->contains('Sócio'))
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
</div>