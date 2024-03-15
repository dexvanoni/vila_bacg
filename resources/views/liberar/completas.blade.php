    @extends('layouts.app')
    <?php

    $perfis = collect([]);
    foreach(explode(',',  Auth::user()->autorizacao) as $info){
        if ($info == 'pe') {
          $perfis->push('Permissionário');
      } elseif ($info == 'de') {
          $perfis->push('Dependente');
      } elseif ($info == 'st') {
          $perfis->push('Sócio-Titular');
      } elseif ($info == 'sd') {
          $perfis->push('Sócio-Dependente');
      } elseif ($info == 'fe') {
          $perfis->push('Funcionário da Escola');
      } elseif ($info == 'ra') {
          $perfis->push('Responsável por Aluno');
      } elseif ($info == 'ps') {
          $perfis->push('Prestador de Serviço');
      } elseif ($info == 'po') {
          $perfis->push('Portaria');
      } elseif ($info == 'si') {
          $perfis->push('Síndico');
      } elseif ($info == 'ad') {
          $perfis->push('Administrador');
      }
      $perfis->all();
    };
    ?>

    @section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img src="/imagens/sisvila.png" width="100px" height="70px">        
            </div>
            <div class="col-md-10">
                <h2>Movimentação de Moradores e Visitantes</h2>
            </div>
        </div>
        
        <hr>
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            <input type="text" class="form-control" placeholder="Procure por qualquer texto..." id="searched">
            <button type="button" class="btn-primary btn-sm" onclick="highlight('0');">
              <i class="fa fa-search"></i>  
          </button>
      </div>
      <hr>
      @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    <hr>
    @endif
    <div class="row select">
        <div class="col-md-12">
            <?php $f = 0; ?>
            <div class="accordion">
                @foreach($liberacoes_moradores as $m)
                <div class="card_{{$f}}">
                    <div class="card-header" id="acordeon_m_{{$f}}">
                      <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne_{{$f}}" aria-expanded="true" aria-controls="collapseOne">
                          @php
                            $morador = DB::table('users')
                                ->where('cpf', $m->morador_id)
                                ->first();
                          @endphp
                          @if($morador)
                          <div class="row" style="margin-top: 5px;">
                                Nome: {{$morador->name}}
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            Movimentação: {{$m->movimento}}
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            Data/Hora: {{date('d/m/Y h:m:i', strtotime($m->created_at))}}
                        </div>
                        @endif

                    </button>
                </h5>
            </div>
        </div>
        @endforeach
    </div>
    <?php $f++;?>
    </div>
    <div class="col-md-12 mb-0">
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $liberacoes_moradores->links() !!}
        </div>        
    </div>
    </div>

    <!--DAR SAÍDA-->
    <div class="row">
        <div class="col-md-12">
            <?php $i = 0; ?>
            <div id="accordion2">
                @foreach($liberacoes_completas as $a)
                <div class="card" id="card_{{$i}}">
                    <div class="card-header" id="headingOne_{{$i}}">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_{{$i}}" aria-expanded="true" aria-controls="collapseOne_{{$i}}">
                            <div class="row">
                                <i class="fas fa-house-user">{{'  '.$a->destino}}</i>
                            </div>
                            <div class="row" style="margin-top: 5px;">
                                <i class="fas fa-user-check">{{'  '.$a->liberador}}</i>  
                            </div>
                            <div class="row" style="margin-top: 5px;">
                                Visitante: {{'  '.$a->nome_completo.'   '}}
                            </div>
                        </button>
                    </h5>
                </div>

                <div id="collapseOne_{{$i}}" class="collapse" aria-labelledby="headingOne_{{$i}}" data-parent="#accordion2">
                  <div class="card-body" id="card_body_{{$i}}">
                    Movimentação nº {{$a->id}} completa:<br>
                    Entrada: {{date('d/m/Y', strtotime($a->dt_entrou))}} às {{$a->hr_entrou}} <br>
                    Saída: {{date('d/m/Y', strtotime($a->dt_saiu))}} às {{$a->hr_saiu}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <?php $i++;?>
    </div>
    <!--FECHA DAR SAÍDA-->
    <div class="col-md-12 mb-0">
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $liberacoes_completas->links() !!}
        </div>        
    </div>
    </div>
    </div>
    <script>
        function highlight(param) {

                // Select the whole paragraph
            var ob = new Mark(document.querySelector(".select"));

                // First unmark the highlighted word or letter
            ob.unmark();

                // Highlight letter or word
            ob.mark(
                document.getElementById("searched").value,
                { className: 'a' + param }
                );
        }
    </script>
    @endsection

