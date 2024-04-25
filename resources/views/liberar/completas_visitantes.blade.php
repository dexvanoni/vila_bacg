    @extends('layouts.app')
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
    };
    ?>

    @section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img src="/imagens/sisvila2.png" width="80px" height="70px">        
            </div>
            <div class="col-md-10">
                <h2>Movimentação de Visitantes</h2>
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

