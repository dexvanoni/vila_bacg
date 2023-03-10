<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Impressão de QR-Code - Cadastrados</title>
	<style type="text/css">
		.cartao {
		 width:250px;
		 height:580px;
		 font-family: Arial;
		 border: 8px solid; /* As 4 bordas sólidas com 25px de espessura */
		 border-color: red; /* cores: topo, direita, inferior, esquerda */
		 padding: 3px;
		 background-color: white;
		 }
		 @media print {
               .notprint {
                  visibility: hidden;
               }
           }
	</style>
</head>
<body>
	<div id="cartao" class="cartao">
	@php
			$perfis = collect([]);
              foreach(explode(',',  $usuario->autorizacao) as $info){
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
	
		<div class="conteudo" style="text-align: center;">
			{!! QrCode::size(250)->generate($usuario->id) !!}
		</div>
			<p style="font-size: 12px;"><strong>Nome:</strong> {{$usuario->name}}</p>
			<p style="font-size: 12px;"><strong>CPF:</strong> {{$usuario->cpf}}</p>
			<p style="font-size: 12px;"><strong>Acesso:</strong> {{$usuario->local}}</p>
			<p style="font-size: 12px;"><strong>Perfil:</strong> 
				@foreach($perfis as $p)
              		{{$p}}<br>
            	@endforeach
			</p>
			<p style="font-size: 12px;">Suporte SISVila: (67) 98167-5854</p>
			<a style="padding-left: 40%;" href='{{$_SERVER['HTTP_REFERER']}}'>Voltar</a><br>
			<button type="button" class="btn btn-primary" style="align-items: center;" id="notprint" onclick="gerarImagem()">Download</button>
	</div>
</body>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">	
    function gerarImagem(){
            domtoimage.toJpeg(document.getElementById('cartao'), { quality: 1})
			    .then(function (dataUrl) {
			        var link = document.createElement('a');
			        link.download = 'meu_cartao_sisvila.jpeg';
			        link.href = dataUrl;
			        link.click();
			   });
    }
    
</script>
</html>