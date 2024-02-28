@extends('layouts.app')

@section('content')
<div class="container">
<div class="row align-items-center">
    <div class="col-md-2">
        <img src="/imagens/sisvila.png" width="100px" height="70px">        
    </div>
</div>
<hr>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Aluno/Responsável: {{$alunos_resp->name}}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <img src = "{{ asset('storage/alunos/'.$alunos_resp->arquivo_resp) }}" class="rounded-circle" style="max-width: 15%;">
                    </div>
                </div>
                <hr>
                <!--SE FOR ALUNO MOSTRA ABAIXO-->
                @if($alunos_resp->tipo_aluno == 'ALUNO')
                <div id="aluno">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Nome:</strong> {{$alunos_resp->nome_aluno}}
                        </div>
                     <div class="col-md-2">
                        <strong>RG:</strong> {{$alunos_resp->rg_aluno}}
                     </div>
                    <div class="col-md-2">
                        <strong>CPF:</strong> {{$alunos_resp->cpf_aluno}}
                    </div>
                    <div class="col-md-4">
                        <strong>Data de Nascimento:</strong> {{date('d/m/Y', strtotime($alunos_resp->dt_nascimento_aluno))}} - <label id="idadeLabel" style="color: red;"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Instituição:</strong> {{$alunos_resp->local_aluno}}
                    </div>
                    <div class="col-md-4">
                        <strong>Série/Grupo:</strong> {{$alunos_resp->serie_aluno}}
                    </div>
                    <div class="col-md-4">
                        <strong>Status:</strong>
                        @if($alunos_resp->status == 1)
                        ATIVO
                        @else
                        INATIVO 
                        @endif
                    </div>
                </div>
            </div>

            @else
            <!--SE FOR RESPONSÁVEL MOSTRA ABAIXO-->
            <div id="responsavel">
                <div class="row">
                    <div class="col-md-4">
                       <strong>Nome:</strong> {{$alunos_resp->nome_resp}}
                   </div>
                   <div class="col-md-2">
                    <strong>RG:</strong> {{$alunos_resp->rg_resp}}
                </div>
                <div class="col-md-2">
                    <strong>CPF:</strong> {{$alunos_resp->cpf_resp}}
                </div>
                <div class="col-md-4">
                    <strong>Email:</strong> {{$alunos_resp->email_resp}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <strong>CPF do Aluno:</strong> {{$alunos_resp->cpf_aluno_resp}}
                </div>
                <div class="col-md-4">
                    <strong>Nome do Aluno:</strong> {{$alunos_resp->nome_aluno_resp}}
                </div>
                <div class="col-md-4">
                    <strong>Status:</strong>
                    @if($alunos_resp->status_aluno == 1)
                    ATIVO <i class="fas fa-lightbulb" style="color: green;"></i>
                    @else
                    INATIVO <i class="fas fa-lightbulb" style="color: red;"></i>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <strong>Nº CNH:</strong> {{$alunos_resp->num_cnh_resp}}
                </div>
                <div class="col-md-3">
                    <strong>Categoria CNH:</strong> {{$alunos_resp->tipo_cnh_resp}}
                </div>
                <div class="col-md-3">
                    <strong>Validade CNH:</strong> {{date('d/m/Y', strtotime($alunos_resp->validade_cnh_resp))}}
                </div>
                <div class="col-md-2">
                    <label id="vencimentoLabel" style="color: red;"></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <strong>CEP:</strong> {{$alunos_resp->cep_resp}}
                </div>
                <div class="col-md-2">
                    <strong>Logradouro:</strong> {{$alunos_resp->rua_resp}}
                </div>
                <div class="col-md-2">
                    <strong>Nº:</strong> {{$alunos_resp->num_casa_resp}}
                </div>
                <div class="col-md-2">
                    <strong>Bairro:</strong> {{$alunos_resp->bairro_resp}}
                </div>
                <div class="col-md-2">
                    <strong>Cidade:</strong> {{$alunos_resp->cidade_resp}}
                </div>
            </div>
            <hr>
            <h6>Imagem da CNH enviada</h6>
            <div class="row align-items-center">
                <div class="col-md-12">
                    <img src = "{{ asset('storage/alunos/'.$alunos_resp->arquivo_cnh_resp) }}" class="img-fluid" style="max-width: 50%;">
                </div>
            </div>
        </div>

        @endif
            <hr>
            <h5>CONTROLES</h5>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-danger" title="Excluir Usuário" href="{{ route('aluno_resp.delete', [$alunos_resp->id]) }}">
                        <i class="fas fa-trash-alt"></i> EXCLUIR
                    </a>
                    <a class="btn btn-secondary" title="Editar cadastro" href="{{ route('aluno_resp.edit', [$alunos_resp->id]) }}">
                        <i class="fas fa-user-edit"></i> EDITAR
                    </a>
                    <!--<a title="QR-Code" href="{{ route('qrcode_organico', [$alunos_resp->id]) }}">
                            <i class="fas fa-qrcode" style="color: green; margin-left: 10PX;"></i>
                        </a>-->
                        @if($alunos_resp->autorizacao <> 'po')
                        <a title="QR-Code" class="btn btn-success" href="#" data-toggle="modal" data-target="#QRView-<?php echo $alunos_resp->id; ?>">
                            <i class="fas fa-qrcode"></i> QR-CODE
                        </a>
                        @endif
                        @if($alunos_resp->status_aluno == 1)
                        <a title="Desabilitar Usuário" class="btn btn-warning" href="{{ route('aluno_resp.desab', [$alunos_resp->id]) }}">
                            <i class="fas fa-dizzy"></i> Desabilitar
                        </a>
                        @else
                        <a title="Habilitar Usuário" class="btn btn-info" href="{{ route('aluno_resp.hab', [$alunos_resp->id]) }}">
                            <i class="fas fa-smile"></i> Habilitar
                        </a>
                        @endif
                    </div>

                </div>
                <!--MODAL QUE EXIBE O QR-CODE-->
                <div class="modal fade" id="QRView-<?=$alunos_resp->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>Usuário: {{$alunos_resp->name}}</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                   {!! QrCode::size(300)->generate($alunos_resp->id) !!}

               </div>
               <div class="modal-footer">

                <a title="QR-Code" href="{{ route('qrcode_alunos', [$alunos_resp->id]) }}">
                 Imprimir
             </a>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
         </div>
     </div>
 </div>
</div>
<!--FIM DO MODAL-->

</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
var dados = @json($alunos_resp->toArray());
// Converte a string da data de nascimento para um objeto Date
var nasc = dados['dt_nascimento_aluno'];
var dataNascimento = new Date(nasc);
// Obtém a data atual
var dataAtual = new Date();

// Calcula a diferença em milissegundos entre as duas datas
var diferencaEmMilissegundos = dataAtual - dataNascimento;

// Converte a diferença de milissegundos para anos
var idade = Math.floor(diferencaEmMilissegundos / (365.25 * 24 * 60 * 60 * 1000));
if (dados['dt_nascimento_aluno'] !== null) {
    document.getElementById("idadeLabel").innerHTML = idade + ' anos';
}

if (dados['validade_cnh_resp'] !== '--') {
        var motorista = dados['validade_cnh_resp'];

    var dataAtual = new Date();
    var dataValidadeObj = new Date(motorista);

    if (dataAtual > dataValidadeObj) {
        document.getElementById("vencimentoLabel").innerHTML = "CNH Vencida!";
    } 
}

</script>  

@endsection
