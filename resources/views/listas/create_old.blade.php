
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Inserir LISTA DE INGRESSO</h2>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Preencha o formulário</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a title="Baixar arquivo" href="{{ route('listas.modelo') }}">
                            <i class="fas fa-download" style="blue"></i> Baixe aqui um modelo de LISTA DE INGRESSO.
                    </a>
                    <hr>
                    <!--<form method="POST" action="{{ route('lista_ingresso.store') }}" enctype="multipart/form-data">-->
                        <form method="POST" action="{{ route('liberacao.import') }}" enctype="multipart/form-data">
                            @csrf
                        <h6>Após o preenchimento da lista, salve o aquivo e faça upload aqui</h6>
                        <small class="form-text text-muted">XLSX (Excel)</small>
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
                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label for="portaria">Portaria</label>
                                    <select class="form-control" id="portaria" name="portaria" required>
                                      <option>Selecione...</option>
                                      <option>PVO - Vila dos Oficiais (Duque de Caxias)</option>
                                      <option>PVSS - Vila dos Suboficiais e Sargentos (Taveirópolis)</option>
                                      <option>Portão Principal - Duque de Caxias</option>
                                      <option>Portão Interno - Área Administrativa</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="qtn">Nº de Convidados</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-person-booth"></i></div>
                                        </div>
                                        <input type="number" name="qtn" class="form-control" id="qtn">
                                      </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="local_evento">Local do Evento</label>
                                    <select class="form-control" id="local_evento" name="local_evento" required>
                                      <option>Selecione...</option>
                                      <option>ALOF</option>
                                      <option>ALSS</option>
                                      <option>ALCTS</option>
                                      <option>PNR</option>
                                      <option>CASARÃO</option>
                                      <option>GINÁSIO DE ESPORTES</option>
                                      <option>ESQUADRÃO</option>
                                      <option>ÁREA ADMINISTRATIVA</option>
                                    </select>
                                  </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                 <label for="dt_evento">Data do Evento</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-sign-in-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control" name="dt_evento" id="dt_evento" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                 <label for="hr_evento">Hora do Evento</label><label style="color: red;">*</label>
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                    <input type="time" class="form-control" name="hr_evento" id="hr_evento" required>
                                  </div>
                                </div>
                                <div class="col-md-5 align-self-end">
                                    <div class="form-group">
                                        <div class="col-md-7">
                                            <button type="submit" class="btn btn-primary">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>


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
    </script>
    
    <script type="module">

    const permission = await Notification.requestPermission()
        if( permission !== "granted") {
          throw new Error('Permissão negada')
        }
            //cria a notificação

            function novaOcorrencia(opcoes) {
            var n = new Notification(opcoes.title, opcoes.opt);
            
            if (opcoes.link !== '') {
                    n.addEventListener("click", function() {               
                        n.close();
                        window.focus();
                        window.location.href = opcoes.link;
                    });
                }
            }

            //aparece a notificação ao clicar
            document.getElementById("btn_push").onclick = evt => {
                novaOcorrencia({
                    opt: {
                        body: "Criando nova notificação",
                        icon: "notification-flat.png"
                    },
                    title: "Olá mundo!",
                    link: "https://www.google.com.br/"
                })
            }

  </script>
@endsection