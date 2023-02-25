<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Impressão de QR-Code - Convidados</title>
	<style type="text/css">
		.cartao {
		 width:250px;
		 height:580px;
		 border: 8px solid; /* As 4 bordas sólidas com 25px de espessura */
		 border-color: #00f #00f #00f #00f; /* cores: topo, direita, inferior, esquerda */
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
	<div class="cartao" id="cartao">
			<div class="conteudo" style="text-align: center;">
				{!! QrCode::size(250)->generate($convidado->id) !!}
			</div>
				<p style="font-size: 12px;"><strong>Nome:</strong> {{$convidado->nome_completo}}</p>
				<p style="font-size: 12px;"><strong>CPF:</strong> {{$convidado->doc}}</p>
				<p style="font-size: 12px;"><strong>Evento:</strong> {{$convidado->lista}} ({{$convidado->destino}})</p>
				<p style="font-size: 13px; color: white; background-color: red; text-align: center;"><strong>Validade:</strong> {{date('d/m/Y', strtotime($convidado->dt_entrada))}} {{date('H:i', strtotime($convidado->hr_entrada))}} <br>até <br> {{date('d/m/Y', strtotime($convidado->dt_saida))}} {{date('H:i', strtotime($convidado->hr_saida))}}</p>
				@php
					$liberador = App\User::find($convidado->onesignal_id);
				@endphp
				<p style="font-size: 12px;"><strong>Autorizado por:</strong> {{$liberador->name}}</p>
				<p style="font-size: 12px;"><strong>Contato Liberador:</strong> {{$liberador->telefone}}</p>
				<p style="font-size: 9px;">Apresentar este cartão no leitor de QR-Code na portaria para entrada na Vila da Base Aérea</p>
				<a id="notprint" style="padding-left: 40%;" href='{{$_SERVER['HTTP_REFERER']}}'>Voltar</a><br>
				<button type="button" class="btn btn-primary" id="notprint" onclick="gerarImagem()">Download</button>
	</div>
</body>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">	
    function gerarImagem(){
    	document.getElementById("notprint").style.display = "none";
            domtoimage.toJpeg(document.getElementById('cartao'), { quality: 1})
			    .then(function (dataUrl) {
			        var link = document.createElement('a');
			        link.download = 'meu_cartao_sisvila.jpeg';
			        link.href = dataUrl;
			        link.click();

			        //var link2 = document.createElement('a');
			        //link2.href = 'https://api.whatsapp.com/send?phone=55{{$convidado->contato}}&text=Você foi convidado para um evento na Vila da Base Aérea. Solicite o cartão com QR-Code para entrada na portaria!';
			        //link2.click();
			   });
    }
    
</script>
</html>
