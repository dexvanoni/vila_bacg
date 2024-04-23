
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Inserir Ocorrência</h2>
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
                    <form method="POST" action="{{ route('ocorrencias.store') }}" enctype="multipart/form-data">
                            @csrf
                        <h6>Faça upload do arquivo caso necessário</h6>
                        <div class="row">
                            <div class="col-md-12">
                                 <div class="form-group">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                      </div>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01" name="arquivo" accept="image/png, image/jpeg">
                                        <label class="custom-file-label" for="arquivo">Clique aqui...</label>
                                      </div>
                                    </div>  
                                  </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="nomeArquivo" style="margin-left: 20px;"></div>
                        </div>

                        <br>
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="4" name="mensagem" placeholder="Digite aqui a ocorrência..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="prioridade">Prioridade</label>
                                    <select class="form-control" id="prioridade" name="prioridade">
                                      <option>Baixa</option>
                                      <option>Média</option>
                                      <option>Alta</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-8 align-self-end">
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