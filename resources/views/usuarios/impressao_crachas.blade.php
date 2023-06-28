@php 
	ini_set('max_execution_time', 300); // Ajuste o valor para o tempo máximo de execução desejado em segundos 
	ini_set('memory_limit', '-1');
@endphp
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Impressão de QR-Code - Cadastrados</title>
	<style type="text/css">
 				@page {
            size: A4;
        }
    .row {
        display: flex;
        flex-wrap: wrap;
    }
    
    .col-md-4 {
        width: 33.33%;
        box-sizing: border-box;
        padding: 0 15px;
    }

    .item {
        page-break-inside: avoid;
    }

		.cartao {
			width:250px;
			height:400px;
			font-family: Arial;
			border: 8px solid; /* As 4 bordas sólidas com 25px de espessura */
			border-color: red; /* cores: topo, direita, inferior, esquerda */
			padding: 3px;
			background-color: white;
		}

	</style>
</head>
<body>

	<div class="row">
    @foreach($crachas->chunk(2) as $grupo)
        <div class="col-md-3">
            @foreach($grupo as $c)
                <!-- Exiba os dados do item -->
                <div class="item">
                	@php
										$perfis = collect([]);
										foreach(explode(',',  $c->autorizacao) as $info){
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
									@endphp
           <div class="cartao" style="
           	@if($c->autorizacao == 'pe') 
           		border-color: blue; 
           		@elseif($c->autorizacao == 'de')
           		border-color: green;
           		@elseif($c->autorizacao == 'fe')
           		border-color: brown;
           		@elseif($c->autorizacao == 'ad')
           		border-color: black;
           		@elseif($c->autorizacao == 'ps')
           		border-color: yellow;
           	@endif
           		">
						<div style="text-align: center;">
							{!! QrCode::size(250)->generate($c->id) !!}
						</div>
						<p style="font-size: 12px;"><strong>Nome:</strong> {{$c->name}}</p>
						<p style="font-size: 12px;"><strong>CPF:</strong> {{$c->cpf}}</p>
						<p style="font-size: 12px;"><strong>Acesso:</strong> {{$c->local}}</p>
						<p style="font-size: 12px;"><strong>Perfil:</strong> 
							@foreach($perfis as $p)
							{{$p}}<br>
							@endforeach
						</p>
						<p style="font-size: 12px;">Suporte SISVila: (67) 98167-5854</p>
					</div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

</body>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</html>