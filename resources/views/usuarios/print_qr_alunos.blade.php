<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Impressão de QR-Code - Alunos e Responsáveis</title>
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

		<div style="text-align: center;">
			@if($usuario->tipo_aluno == 'ALUNO')
				{!! QrCode::size(250)->generate($usuario->cpf_aluno) !!}
			@else
				{!! QrCode::size(250)->generate($usuario->cpf_resp) !!}
			@endif
		</div>
			<p style="font-size: 12px;"><strong>Nome:</strong> @if($usuario->tipo_aluno == 'ALUNO') {{$usuario->nome_aluno}} @else {{$usuario->nome_resp}} @endif </p>
			<p style="font-size: 12px;"><strong>CPF:</strong> @if($usuario->tipo_aluno == 'ALUNO') {{$usuario->cpf_aluno}} @else {{$usuario->cpf_resp}} @endif</p>
			<p style="font-size: 12px;"><strong>Acesso:</strong> @if($usuario->tipo_aluno == 'ALUNO') {{$usuario->local_aluno}} @else @php $local_resp = DB::table('alunos')->where('cpf_aluno', '=', $usuario->cpf_aluno_resp)->first(); echo $local_resp->local_aluno; @endphp  @endif</p>
			<p style="font-size: 12px;"><strong>Perfil:</strong> 
				@if($usuario->tipo_aluno == 'ALUNO') 
					Estudante do(a) {{$usuario->serie_aluno}}
				@else
					Responsável pelo aluno: {{$local_resp->nome_aluno}}
				@endif
			</p>
			<p style="font-size: 12px;">Suporte SISVila: (67) 98167-5854</p>
			<a style="padding-left: 40%;" href='{{$_SERVER['HTTP_REFERER']}}'>Voltar</a><br>
			<button type="button" class="btn btn-primary" style="align-items: center;" id="notprint" onclick="gerarImagem()">Download</button>
	</div>
</body>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script type="text/javascript">	
    function gerarImagem(){
            domtoimage.toJpeg(document.getElementById('cartao'), { quality: 1})
			    .then(function (dataUrl) {
			        var link = document.createElement('a');
			        link.download = 'meu_cartao_sisvila.jpeg';
			        link.href = dataUrl;
			        link.click();
			   });
    };

			
    function getPDF(){
    	 var doc = new jsPDF();
 
			  // We'll make our own renderer to skip this editor
			  var specialElementHandlers = {
			    '#getPDF': function(element, renderer){
			      return true;
			    },
			    '.controls': function(element, renderer){
			      return true;
			    }
			  };

			  // All units are in the set measurement for the document
			  // This can be changed to "pt" (points), "mm" (Default), "cm", "in"
			  doc.fromHTML($('.cartao').get(0), 15, 15, {
			    'width': 250, 
			    'elementHandlers': specialElementHandlers
			  });

			  doc.save('meu_qrcode.pdf');
    };
    
</script>
</html>