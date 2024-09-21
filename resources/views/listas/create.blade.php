@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Lista de Convidados</h2>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Preencha os campos e faça upload do arquivo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <hr>
                    <a title="Baixar arquivo" href="{{ route('listas.modelo') }}">
                            <i class="fas fa-download" style="blue"></i> Baixe aqui um modelo de LISTA DE INGRESSO.
                    </a>
                    <hr>
                    <!--se o rádio for marcado "Evento Área de Lazer" vai cadastrar e colocar em qual clube"-->
                    <div id="conv">
                    <form method="POST" action="{{ route('liberacao.import') }}" enctype="multipart/form-data">
                        @csrf
                        <h6>Após o preenchimento da lista, salve o aquivo e faça upload aqui</h6>
                        <small class="form-text text-muted">**Importante: Somente arquivos XLSX (Excel) preenchidos conforme modelo</small>
                        <div class="row">
                            <div class="col-md-12">
                                 <div class="form-group">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                      </div>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01" name="arquivo" accept=".xlsx" required>
                                        <label class="custom-file-label" for="arquivo">Clique aqui...</label>
                                      </div>
                                    </div>  
                                  </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="nomeArquivo" style="margin-left: 20px;"></div>
                        </div>
                        <hr>
                        <label for="mensagem">Preencha o formulário</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lista">Local do Evento</label>
                                    <select class="form-control" id="destino" name="destino">
                                      <option>Selecione...</option>  
                                      <option>ALOF</option>  
                                      <option>ALSS</option>
                                      <option>ALCTS</option>
                                      <option>CASARÃO</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-9">
                                    <label for="lista">Nome da Lista (título do seu evento)</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-clipboard-list"></i></div>
                                        </div>
                                        <input type="text" name="lista" class="form-control" id="lista" placeholder="Exemplo: Aniversário do João">
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
                            <input type="hidden" name="documento" value="uploadLista">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <!--RELAÇÃO DE LISTAS DO USUÁRIO LOGADO-->
                      <table id="lista_listas" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome da Lista</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(($listas) as $a => $b)
                                <tr>
                                    <td>{{$a}}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{route('ver_lista', ['lista' => $a])}}">
                                            <i class="fas fa-book-open"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

@endsection

@section('script_adicional')
    <script type="text/javascript">
         $(function () {
            $('#arquivo').change(function() {
                 $('.nomeArquivo').html('<b>Arquivo Selecionado:</b> ' + $(this).val());
            });
         });

        $(document).ready(function(){

            //esconder todos os forms
            $("#anterior").hide();
            $("#entrega").hide();
            $("#transp").hide();
            $("#new").hide();
            //$("#conv").hide();

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

@section('script_datatable')
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#lista_listas').DataTable({
                 responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Details for '+data[0]+' '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            });
        });
    </script>

@endsection