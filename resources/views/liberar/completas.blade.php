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
                <h2>Movimentação de Usuários</h2>
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
                            $aluno = DB::table('alunos')
                                ->where('cpf_aluno', $m->morador_id)
                                ->first();
                            $resp = DB::table('alunos')
                                ->where('cpf_resp', $m->morador_id)
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
                        @if($aluno)
                            <div class="row" style="margin-top: 5px;">
                                Aluno(a): {{$aluno->nome_aluno}}
                            </div>
                            <div class="row" style="margin-top: 5px;">
                                Movimentação: {{$m->movimento}}
                            </div>
                            <div class="row" style="margin-top: 5px;">
                                Data/Hora: {{date('d/m/Y h:m:i', strtotime($m->created_at))}}
                            </div>
                        @endif
                        @if($resp)
                            <div class="row" style="margin-top: 5px;">
                                Responsável por aluno(a): {{$resp->nome_resp}}
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

