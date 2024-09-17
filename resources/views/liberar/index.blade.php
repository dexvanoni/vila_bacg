@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Lista de Visitantes Cadastrados</h2>
        </div>
    </div>
    
    <hr>
    @if (in_array('ad', $userProfiles) || in_array('po', $userProfiles))
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('movimentacao')}}" class="btn btn-info" title="Movimentações">ENTRADA/SAÍDA</a>    
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Movimentações
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('liberacao.completa')}}">Moradores</a>
                <a class="dropdown-item" href="{{route('liberacao.completa_visitantes')}}">Visitantes</a>
                <!--<a class="dropdown-item" href="{{route('lista_ingresso.lista')}}">Listas de Ingresso</a>-->
              </div>
            </div>
            <!--<div class="col-md-6 align-self-end">
                <a href="{{route('lista_ingresso.lista')}}" class="btn btn-warning" title="Ver movimentações">Ver listas de ingresso</a>    
            </div>-->
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
                @if($check)
                  <div class="card" id="card_{{$i}}">
                    <div class="card-header" id="headingOne_{{$i}}">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_{{$i}}" aria-expanded="true" aria-controls="collapseOne_{{$i}}">
                            <div class="row">
                                @if($a->movimentacao == 'E')
                                    <label style="color: red;">Este visitante já entrou!</label>
                                @elseif($a->movimentacao == 'A')
                                    @if($a->status == 'Liberado')                                
                                    @else
                                        <label style="background-color: red; color: white;">VISITANTE BLOQUEADO</label>
                                    @endif    
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
                                Visitante: {{'  '.$a->apelido}} ( {{$a->nome_completo}} ) - Contato: {{' '.$a->contato}}
                            </div>
                            @if(!is_null($a->observacao))
                            <div class="row" style="margin-top: 5px; color: red;">
                                Observação: {{'  '.$a->observacao}}
                            </div>
                            @endif
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
                  @endif
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
                                        Visitante: {{'  '.$a->nome_completo.'   '}} Contato: {{' '.$a->contato}}
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

    <script>
        document.querySelector('input').addEventListener('click', function () {
          navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
              // Cria um objeto de vídeo HTML e define seu atributo "srcObject"
              var video = document.createElement('video');
              video.srcObject = stream;
              video.play();
              
              // Cria um objeto de tela de canvas HTML
              var canvas = document.createElement('canvas');
              var context = canvas.getContext('2d');
              
              // Adiciona um evento de escuta para a mudança de quadro do objeto de vídeo
              video.addEventListener('play', function () {
                var frameId = setInterval(function () {
                  // Desenha o quadro atual do objeto de vídeo no canvas
                  context.drawImage(video, 0, 0, canvas.width, canvas.height);
                  
                  // Obtém os dados da imagem do canvas
                  var imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                  
                  // Chama a função de leitura de QR code e exibe o resultado
                  var code = jsQR(imageData.data, imageData.width, imageData.height);
                  if (code) {
                    console.log('QR code detectado: ' + code.data);
                  }
                }, 100);
              });
            })
            .catch(function (err) {
              console.log('Ocorreu um erro ao acessar a câmera do dispositivo: ' + err.message);
            });
        });
    </script>
@endsection

