@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila.png" width="100px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Liberação de Visitante</h2>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Selecione o tipo de visitante</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo" id="a" value="anterior">
                              <label class="form-check-label" for="tipo">
                                <i class="fas fa-user-check"></i> Visitante já cadastrado
                              </label>
                            </div>                            
                        </div> 
                        <div class="col-md-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo" id="b" value="novo">
                              <label class="form-check-label" for="tipo">
                                <i class="fas fa-user-plus"></i> Novo Visitante
                              </label>
                        </div>                            
                        </div> 
                        <div class="col-md-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo" id="c" value="entregador">
                              <label class="form-check-label" for="tipo">
                                <i class="fas fa-gift"></i> Entregador
                              </label>
                            </div>                            
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo" id="d" value="transporte">
                              <label class="form-check-label" for="tipo">
                                <i class="fas fa-shipping-fast"></i> Transporte
                              </label>
                            </div>                            
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo" id="e" value="convidado">
                              <label class="form-check-label" for="tipo">
                                <i class="fas fa-glass-cheers"></i> Convidado Área de Lazer
                              </label>
                            </div>                            
                        </div>
                    </div>

                    <hr>

                    <!--se o rádio for marcado "Visitante já cadastrado" vai pesquisar por apelido"-->
                    <div id="anterior">
                    <form method="POST" action="{{ route('liberacao.anterior') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="mensagem">Procure pelo Apelido cadastrado</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fab fa-searchengin"></i></div>
                                        </div>
                                            <input class="form-control" list="apelidos" id="lista_apelidos" name="apelido" placeholder="Pesquisa automática"  autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                 <label for="observacao">Observação</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-comment-dots"></i></div>
                                    </div>
                                    <input type="text" name="observacao" class="form-control" id="observacao">
                                  </div>
                            </div>
                            <datalist id="apelidos">
                                @foreach($visita as $vi)
                                    <option value="{{$vi->apelido}}">
                                @endforeach
                            </datalist>
                        </div>

                        <!--TRECHO COMUM PARA TODOS-->
                                <div class="row">
                                <div class="col-md-3">
                                 <label for="dt_entrada">Data Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-in-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_entrada" id="dt_entrada" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_entrada">Hora Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_entrada" id="hr_entrada" value="{{Carbon\Carbon::now()->format('H:i')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="dt_saida">Data Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-out-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_saida" id="dt_saida" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_saida">Hora Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-stopwatch"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_saida" id="hr_saida" required>
                                  </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_l" value="Liberado" required checked>
                                      <label class="form-check-label" for="tipo" style="color: green;">
                                        <i class="fas fa-user-check fa-2x" style="color: green;"></i> <font size="5"> Liberado</font>
                                      </label>
                                    </div>                            
                                </div> 
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_b" value="Bloqueado">
                                      <label class="form-check-label" for="tipo" style="color: red;">
                                        <i class="fas fa-user-slash fa-2x" style="color: red;"></i><font size="5"> Bloqueado</font>
                                      </label>
                                    </div>                            
                                </div> 
                            </div>
                            <br>
                            <!--FIM-->
                        <br>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    </div>
                    <!--fecha "Visitante já cadastrado" -->

                    <!--se o rádio for marcado "Entrega" vai marcar o radio correspondente"-->
                    <div id="entrega">
                    <form method="POST" action="{{ route('liberacao.entregador') }}">
                        @csrf
                        <label for="mensagem">Selecione uma opção</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="apelido" id="ifood" value="IFood" checked>
                                  <label class="form-check-label" for="entregador"><i class="fas fa-hamburger"></i> IFood</label>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="apelido" id="particular" value="Particular">
                                  <label class="form-check-label" for="entregador"><i class="fas fa-cart-plus"></i> Particular</label>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="apelido" id="farmacia" value="Farmácia">
                                  <label class="form-check-label" for="entregador"><i class="fas fa-clinic-medical"></i> Farmácia</label>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="apelido" id="pizzaria" value="Pizzaria">
                                  <label class="form-check-label" for="entregador"><i class="fas fa-pizza-slice"></i> Pizzaria</label>
                                </div>                            
                            </div>
                        </div>
                        <br>
                        <!--TRECHO COMUM PARA TODOS-->
                        <div class="row">
                            <div class="col-md-12">
                                 <label for="observacao">Observação</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-comment-dots"></i></div>
                                    </div>
                                    <input type="text" name="observacao" class="form-control" id="observacao">
                                  </div>
                            </div>
                        </div>
                                 <div class="row">
                                <div class="col-md-3">
                                 <label for="dt_entrada">Data Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-in-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_entrada" id="dt_entrada" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_entrada">Hora Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_entrada" id="hr_entrada" value="{{Carbon\Carbon::now()->format('H:i')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="dt_saida">Data Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-out-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_saida" id="dt_saida" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_saida">Hora Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-stopwatch"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_saida" id="hr_saida" required>
                                  </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_l" value="Liberado" required checked>
                                      <label class="form-check-label" for="tipo" style="color: green;">
                                        <i class="fas fa-user-check fa-2x" style="color: green;"></i> <font size="5"> Liberado</font>
                                      </label>
                                    </div>                            
                                </div> 
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_b" value="Bloqueado">
                                      <label class="form-check-label" for="tipo" style="color: red;">
                                        <i class="fas fa-user-slash fa-2x" style="color: red;"></i><font size="5"> Bloqueado</font>
                                      </label>
                                    </div>                            
                                </div> 
                            </div>
                            <br>
                            <!--FIM-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
                    <!--fecha "Entregadores" -->

                    <!--se o rádio for marcado "Transporte" vai marcar o radio correspondente"-->
                    <div id="transp">
                    <form method="POST" action="{{ route('liberacao.transporte') }}">
                        @csrf
                        <label for="mensagem">Selecione uma opção</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="apelido" id="motorista" value="Motorista App" checked>
                                  <label class="form-check-label" for="entregador"><i class="fab fa-uber"></i> Motorista App (Uber, 99)</label>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="apelido" id="mudanca" value="Mudança">
                                  <label class="form-check-label" for="entregador"><i class="fas fa-truck-loading"></i> Frete / Mudança</label>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="apelido" id="taxi" value="Taxi">
                                  <label class="form-check-label" for="entregador"><i class="fas fa-taxi"></i> Táxi / Mototáxi</label>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="apelido" id="transportadora" value="Transportadora">
                                  <label class="form-check-label" for="entregador"><i class="fas fa-dolly"></i> Transportadora</label>
                                </div>                            
                            </div>
                        </div>
                        <br>
                        <!--TRECHO COMUM PARA TODOS-->
                        <div class="row">
                                <div class="col-md-12">
                                     <label for="observacao">Observação</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-comment-dots"></i></div>
                                        </div>
                                        <input type="text" name="observacao" class="form-control" id="observacao">
                                      </div>
                                </div>
                        </div>
                                 <div class="row">
                                <div class="col-md-3">
                                 <label for="dt_entrada">Data Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-in-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_entrada" id="dt_entrada" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_entrada">Hora Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_entrada" id="hr_entrada" value="{{Carbon\Carbon::now()->format('H:i')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="dt_saida">Data Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-out-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_saida" id="dt_saida" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_saida">Hora Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-stopwatch"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_saida" id="hr_saida" required>
                                  </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_l" value="Liberado" required checked>
                                      <label class="form-check-label" for="tipo" style="color: green;">
                                        <i class="fas fa-user-check fa-2x" style="color: green;"></i> <font size="5"> Liberado</font>
                                      </label>
                                    </div>                            
                                </div> 
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_b" value="Bloqueado">
                                      <label class="form-check-label" for="tipo" style="color: red;">
                                        <i class="fas fa-user-slash fa-2x" style="color: red;"></i><font size="5"> Bloqueado</font>
                                      </label>
                                    </div>                            
                                </div> 
                            </div>
                            <br>
                            <!--FIM-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    </div>
                    <!--fecha "Transporte" -->

                    <!--se o rádio for marcado "Evento Área de Lazer" vai cadastrar e colocar em qual clube"-->
                    <div id="conv">
                        <i class="fas fa-clipboard-list"></i> Para envio de lista de convidados,<a href="{{route('lista_ingresso.index')}}"> clique aqui!</a>
                     <hr>  
                    <form method="POST" action="{{ route('liberacao.convidado') }}">
                        @csrf
                        <label for="mensagem">Preencha o formulário</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" id="destino" name="destino">
                                      <option>Selecione o local do envento...</option>  
                                      <option>ALOF</option>  
                                      <option>ALSS</option>
                                      <option>ALCTS</option>
                                      <option>CASARÃO</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-3">
                                 <label class="sr-only" for="nome_completo">Nome completo</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="nome_completo" name="nome_completo" placeholder="Nome do convidado" required>
                                  </div>
                            </div>
                            <div class="col-md-3">
                                 <label class="sr-only" for="veiculo">Veículo</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-car-alt"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="veiculo" name="veiculo" placeholder="Moto, carro, caminhão...">
                                  </div>
                            </div>
                            <div class="col-md-3">
                                 <label class="sr-only" for="cor_veiculo">Cor do Veículo</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-palette"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="cor_veiculo" name="cor_veiculo" placeholder="Preto, branco, azul...">
                                  </div>
                            </div>  
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                     <label for="observacao">Observação</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-comment-dots"></i></div>
                                        </div>
                                        <input type="text" name="observacao" class="form-control" id="observacao">
                                      </div>
                                </div>
                        </div>
                        <br>
                        
                        <!--TRECHO COMUM PARA TODOS-->
                                 <div class="row">
                                <div class="col-md-3">
                                 <label for="dt_entrada">Data Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-in-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_entrada" id="dt_entrada" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_entrada">Hora Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_entrada" id="hr_entrada" value="{{Carbon\Carbon::now()->format('H:i')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="dt_saida">Data Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-out-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_saida" id="dt_saida" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_saida">Hora Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-stopwatch"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_saida" id="hr_saida" required>
                                  </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_l" value="Liberado" required checked>
                                      <label class="form-check-label" for="tipo" style="color: green;">
                                        <i class="fas fa-user-check fa-2x" style="color: green;"></i> <font size="5"> Liberado</font>
                                      </label>
                                    </div>                            
                                </div> 
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_b" value="Bloqueado">
                                      <label class="form-check-label" for="tipo" style="color: red;">
                                        <i class="fas fa-user-slash fa-2x" style="color: red;"></i><font size="5"> Bloqueado</font>
                                      </label>
                                    </div>                            
                                </div> 
                            </div>
                            <br>
                            <!--FIM-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    </div>
                    <!--fecha "Visitante já cadastrado" -->


                    <!--se o rádio for marcado "Novo Visitante" vai fazer um novo cadastro"-->
                    <div id="new">
                    <form method="POST" action="{{ route('liberacao.novo') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="apelido">Digite um apelido</label><label style="color: red;">*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user-ninja"></i></div>
                                            </div>
                                                <input class="form-control" id="apelido" name="apelido" placeholder="Vidraceiro João" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nome_completo">Nome Completo</label><label style="color: red;">*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user-tag"></i></div>
                                            </div>
                                                <input class="form-control" id="nome_completo" name="nome_completo" placeholder="João da Silva" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="funcao">Função</label>
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="funcao" name="funcao" placeholder="Vidraceiro, Marceneiro..." required>
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="doc">Documento</label>
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="doc" name="doc" placeholder="CPF, RG, Funcional..." required>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="veiculo">Veículo</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-car-alt"></i></div>
                                    </div>
                                    <input type="text" name="veiculo" class="form-control" id="veiculo" placeholder="Moto, carro, caminhão...">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                 <label for="cor_veiculo">Cor do Veículo</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-palette"></i></div>
                                    </div>
                                    <input type="text" name="cor_veiculo" class="form-control" id="cor_veiculo" placeholder="Preto, branco, azul...">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                 <label for="observacao">Observação</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-comment-dots"></i></div>
                                    </div>
                                    <input type="text" name="observacao" class="form-control" id="observacao">
                                  </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-3">
                                 <label for="dt_entrada">Data Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-in-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_entrada" id="dt_entrada" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_entrada">Hora Entrada</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_entrada" id="hr_entrada" value="{{Carbon\Carbon::now()->format('H:i')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="dt_saida">Data Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-out-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_saida" id="dt_saida" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_saida">Hora Saída</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-stopwatch"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_saida" id="hr_saida" required>
                                  </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_l" value="Liberado" required checked>
                                      <label class="form-check-label" for="tipo" style="color: green;">
                                        <i class="fas fa-user-check fa-2x" style="color: green;"></i> <font size="5"> Liberado</font>
                                      </label>
                                    </div>                            
                                </div> 
                                <div class="col-md-4 align-self-center text-center">
                                    <div class="form-check ">
                                      <input class="form-check-input" type="radio" name="status" id="status_b" value="Bloqueado">
                                      <label class="form-check-label" for="tipo" style="color: red;">
                                        <i class="fas fa-user-slash fa-2x" style="color: red;"></i><font size="5"> Bloqueado</font>
                                      </label>
                                    </div>                            
                                </div> 
                            </div>
                            <br>
                            <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

@endsection

@section('script_adicional')
    <script type="text/javascript">
        $(document).ready(function(){

            //esconder todos os forms
            $("#anterior").hide();
            $("#entrega").hide();
            $("#transp").hide();
            $("#new").hide();
            $("#conv").hide();

            $("input[id$='a']").click(function() {
                var tipos = $(this).val();
                if (tipos === 'anterior') {
                    $("#anterior").show();
                    $("#entrega").hide();
                    $("#transp").hide();
                    $("#new").hide();
                    $("#conv").hide();
                }
            });

            $("input[id$='b']").click(function() {
                var tipos = $(this).val();
                if (tipos === 'novo') {
                    $("#anterior").hide();
                    $("#entrega").hide();
                    $("#transp").hide();
                    $("#new").show();
                    $("#conv").hide();
                }
            });

            $("input[id$='c']").click(function() {
                var tipos = $(this).val();
                if (tipos === 'entregador') {
                    $("#anterior").hide();
                    $("#entrega").show();
                    $("#transp").hide();
                    $("#new").hide();
                    $("#conv").hide();
                }

            });

            $("input[id$='d']").click(function() {
                var tipos = $(this).val();
                if (tipos === 'transporte') {
                    $("#anterior").hide();
                    $("#entrega").hide();
                    $("#transp").show();
                    $("#new").hide();
                    $("#conv").hide();
                }

            });

            $("input[id$='e']").click(function() {
                var tipos = $(this).val();
                if (tipos === 'convidado') {
                    $("#anterior").hide();
                    $("#entrega").hide();
                    $("#transp").hide();
                    $("#new").hide();
                    $("#conv").show();
                }       

            });
            
        });
    </script>
@endsection
