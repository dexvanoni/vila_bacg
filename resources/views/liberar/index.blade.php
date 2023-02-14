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
            <h2>Lista de Visitantes Cadastrados</h2>
        </div>
    </div>
    
    <hr>
    @if ($perfis->contains('Administrador') || $perfis->contains('Portaria'))
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('liberacao.completa')}}" class="btn btn-success" title="Ver movimentações">Clique aqui para ver todas as movimentações</a>    
            </div>
            <div class="col-md-6 align-self-end">
                <a href="{{route('lista_ingresso.lista')}}" class="btn btn-warning" title="Ver movimentações">Ver listas de ingresso</a>    
            </div>
        </div>
    @endif
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
        <div class="col-md-6">
            <h4>Liberações para Entrada</h4>
                <?php $i = 0; ?>
            <div id="accordion">
                @foreach($liberacoes_entradas as $a)
                @php
                                            $dt_hoje = Carbon\Carbon::now()->format('Y-m-d');
                                            $hora = Carbon\Carbon::now()->format('H:i:s');
                                            
                                            $data_ent = $a->dt_entrada.' '.$a->hr_entrada;
                                            $data_saida = $a->dt_saida.' '.$a->hr_saida ;

                                            $dt_e = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data_ent);
                                            $dt_s = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data_saida);

                                            $check = \Carbon\Carbon::now()->between($dt_e, $dt_s);
                @endphp
                  <div class="card" id="card_{{$i}}">
                    <div class="card-header" id="headingOne_{{$i}}">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_{{$i}}" aria-expanded="true" aria-controls="collapseOne_{{$i}}">
                            <div class="row">
                                @if($a->movimentacao == 'E')
                                    <label style="color: red;">Este visitante já entrou!</label>
                                @elseif($a->movimentacao == 'A')
                                    <label>Liberação de visitante nº {{$a->id}}</label>
                                    @if($a->dt_entrada < \Carbon\Carbon::now()->format('Y-m-d') || $a->dt_saida < \Carbon\Carbon::now()->format('Y-m-d'))
                                        <i class="fas fa-exclamation-triangle" style="color: darkred;" title="INVALIDAR ESTA LIBERAÇÃO"></i>
                                    @endif
                                @else
                                    <label style="color: green;">Movimentação completa</label>
                                @endif
                            </div>
                            <div class="row">
                                <i class="fas fa-house-user">{{'  '.$a->destino}}</i>
                            </div>
                            <div class="row" style="margin-top: 5px;">
                                <i class="fas fa-user-check">{{'  '.$a->liberador}}</i>  
                            </div>
                            <div class="row" style="margin-top: 5px;">
                                Visitante: {{'  '.$a->nome_completo}}
                            </div>
                        </button>
                      </h5>
                    </div>

                    <div id="collapseOne_{{$i}}" class="collapse" aria-labelledby="headingOne_{{$i}}" data-parent="#accordion">
                      <div class="card-body" id="card_body_{{$i}}">
                                        @if($check)
                                            <a class="btn btn-success" href="{{route('notificar_entrada', ['onesignal' => $a->onesignal_id, 'id' => $a->id])}}">Entrada</a>
                                        @else
                                             <i class="fas fa-user-clock" style="color: red;"></i>Este visitante não pode entrar na vila! O período liberado foi: <strong>{{date('d/m/Y', strtotime($a->dt_entrada))}} às {{$a->hr_entrada}} até o dia {{date('d/m/Y', strtotime($a->dt_saida))}} às {{$a->hr_saida}}</strong>
                                             @if($dt_e < \Carbon\Carbon::now() || $dt_s < \Carbon\Carbon::now())
                                                <br><a class="btn btn-warning" href="{{route('invalidar_entrada', ['onesignal' => $a->onesignal_id, 'id' => $a->id])}}">INVALIDAR LIBERAÇÃO!</a>
                                             @endif
                                        @endif
                      </div>
                    </div>
                  </div>
                <?php $i++;?>
                @endforeach
            </div>
        </div>

        <!--DAR SAÍDA-->
        <div class="col-md-6 select">
            <h4>Saída de visitante</h4>
                        <?php $i = 0; ?>
                    <div id="accordion2">
                        @foreach($liberacoes_saidas as $a)
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
                                        @php
                                            $dt_hoje = Carbon\Carbon::now()->format('Y-m-d');
                                            $hora = Carbon\Carbon::now()->format('H:i:s');
                                            
                                            $data_ent = $a->dt_entrada.' '.$a->hr_entrada;
                                            $data_saida = $a->dt_saida.' '.$a->hr_saida ;

                                            $dt_e = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data_ent);
                                            $dt_s = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data_saida);

                                        @endphp
                                        @if(\Carbon\Carbon::now()->gt($dt_s))
                                            <i class="fas fa-user-clock" style="color: red;" title="Este visitante já deveria ter saído da vila!"></i>
                                        @endif
                                    </div>
                                    <strong>Ele deve sair até o dia {{date('d/m/Y', strtotime($a->dt_saida))}} às {{$a->hr_saida}}</strong>
                                </button>
                              </h5>
                            </div>

                            <div id="collapseOne_{{$i}}" class="collapse" aria-labelledby="headingOne_{{$i}}" data-parent="#accordion2">
                              <div class="card-body" id="card_body_{{$i}}">
                                @if(($a->movimentacao == 'A'))
                                    <a class="btn btn-success" href="{{route('notificar_entrada', ['onesignal' => $a->onesignal_id, 'id' => $a->id])}}">Entrada</a>
                                @elseif($a->movimentacao == 'E')
                                    <a class="btn btn-danger" href="{{route('notificar_saida', ['onesignal' => $a->onesignal_id, 'id' => $a->id])}}">Saída</a>
                                @elseif($a->movimentacao == 'S')
                                    Movimentação completa:<br>
                                    Entrada: {{date('d-m-Y', strtotime($a->dt_entrou))}} às {{$a->hr_entrou}} <br>
                                    Saída: {{date('d-m-Y', strtotime($a->dt_saiu))}} às {{$a->hr_saiu}}
                                @endif
                              </div>
                            </div>
                          </div>
                        <?php $i++;?>
                        @endforeach
                    </div>
                </div>
        <!--FECHA DAR SAÍDA-->

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

