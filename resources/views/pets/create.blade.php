@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila.png" width="100px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Cadastrar meu Pet</h2>
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
                    <form method="POST" action="{{ route('pets.store') }}" enctype="multipart/form-data">
                            @csrf
                        <h6>Faça upload da foto do seu pet</h6>
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
                                <div class="col-md-6">
                                    <label for="tipo">Tipo de animal</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-paw"></i></div>
                                        </div>
                                        <input type="text" name="tipo" class="form-control" id="tipo" placeholder="Cachorro, gato, coelho...">
                                      </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="coleira">Identificação na coleira ou nome do Pet</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-tags"></i></div>
                                        </div>
                                        <input type="text" name="coleira" class="form-control" id="coleira">
                                      </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="raca">Raça</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-cat"></i></div>
                                        </div>
                                        <input type="text" name="raca" class="form-control" id="raca">
                                      </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="porte">Porte</label>
                                    <select class="form-control" id="porte" name="porte">
                                      <option>Selecione...</option>
                                      <option>GRANDE</option>
                                      <option>MÉDIO</option>
                                      <option>PEQUENO</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="cor">Cor</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-palette"></i></div>
                                        </div>
                                        <input type="text" name="cor" class="form-control" id="cor">
                                      </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-primary">
                                                Enviar
                                        </button>
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
             $('.nomeArquivo').html('<b>Foto Selecionada:</b> ' + $(this).val());
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