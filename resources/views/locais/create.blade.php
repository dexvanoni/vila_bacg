@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Criar Local ou Edificação</h2>
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
                    <form method="POST" action="{{ route('locais.store') }}" enctype="multipart/form-data">
                            @csrf
                        <h6>Faça upload da foto da fachada do local</h6>
                        <div class="row">
                            <div class="col-md-8">
                                 <div class="form-group">
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01" name="arquivo" accept="image/png, image/jpeg">
                                        <label class="custom-file-label" for="arquivo">Clique aqui...</label>
                                      </div>
                                    </div>  
                                  </div>
                            </div>
                            <div class="col-md-4">
                                  <div class="form-group">
                                    <select class="form-control" id="status" name="status">
                                      <option>Selecione...</option>
                                      <option>OCUPADO</option>
                                      <option>DESOCUPADO</option>
                                      <option>EM OBRA</option>
                                    </select>
                                  </div>
                                </div>
                        </div>

                        <div class="row">
                            <div class="nomeArquivo" style="margin-left: 20px;"></div>
                        </div>

                        <br>
                        <hr>
                            <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select class="form-control" id="tipo" name="tipo">
                                      <option>PNR</option>
                                      <option>POSTO DE SERVIÇO</option>
                                      <option>PNR FUNCIONAL</option>
                                      <option>ÁREA DE LAZER</option>
                                      <option>BACG</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="local">Endereço</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-building"></i></div>
                                        </div>
                                        <input type="text" name="local" class="form-control" id="local" placeholder="Exemplo: FOX2010" pattern="[A-Z0-9\s]+$">
                                      </div>
                                </div>
                                <div class="col-md-5">
                                <div class="form-group">
                                    <label for="responsavel">Vincular a alguém</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fab fa-searchengin"></i></div>
                                        </div>
                                            <input class="form-control" list="nomes" id="lista_nomes" name="responsavel" placeholder="Pesquisa automática"  autocomplete="off">
                                    </div>
                                    <datalist id="nomes">
                                        @php
                                            $nomes = DB::table('users')->select('name')->get();
                                        @endphp
                                        @foreach($nomes as $n)
                                            <option value="{{$n->name}}">
                                        @endforeach
                                    </datalist>
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