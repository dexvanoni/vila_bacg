@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila.png" width="100px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Novo aviso</h2>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Criar novo aviso</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('avisos.store') }}" enctype="multipart/form-data">
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
                                        <input type="file" class="custom-file-input" id="arquivo" aria-describedby="inputGroupFileAddon01" name="arquivo">
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
                                    <label for="mensagem">Título</label>
                                    <input class="form-control" id="titulo" name="titulo">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mensagem">Mensagem</label>
                                    <textarea class="form-control" id="area1" rows="3" name="mensagem"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="duracao">Duração (em dias)</label>
                                    <input type="number" class="form-control" id="duracao" name="duracao">
                                  </div>
                            </div>
                        
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="a_quem">Direcionado a</label>
                                    <select class="form-control" id="a_quem" name="a_quem">
                                      <option>TODOS</option>  
                                      <option>PNR - F.2018</option>
                                      <option>PNR - F.2017</option>
                                      <option>ESCOLA YP</option>
                                      <option>CRECHE</option>
                                      <option>ALSS</option>
                                      <option>ALOF</option>
                                      <option>ALCTS</option>
                                      <option>ACVBACG</option>
                                      <option>AALMACG</option>
                                      <option>PREFEITURA</option>
                                    </select>
                                  </div>
                            </div>
                        </div>

                        <input type="hidden" name="dono" value="{{Auth::user()->name}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Publicar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
    $('#arquivo').change(function() {
         $('.nomeArquivo').html('<b>Arquivo Selecionado:</b> ' + $(this).val());
    });
});
</script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() }); // convert all text areas to rich text editor on that page

        bkLib.onDomLoaded(function() {
             new nicEditor().panelInstance('area1');
        }); // convert text area with id area1 to rich text editor.

</script>
@endsection
