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
		 border: 8px solid; /* As 4 bordas sólidas com 25px de espessura */
		 border-color: #00f #00f #00f #00f; /* cores: topo, direita, inferior, esquerda */
		 padding: 3px;
		 }
	</style>
</head>
<body>
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
	<div class="cartao">
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
			<a style="padding-left: 40%;" href='{{$_SERVER['HTTP_REFERER']}}'>Voltar</a>
	</div>
</body>
<script type="text/javascript">
	//alert('Aperte Ctrl+P para imprimir seu QR-Code')
</script>
</html>