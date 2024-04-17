<!DOCTYPE html>
<html>
<head>
	<title>Usuário DESABILITADO</title>
	<script>
		window.onload = function() {
			alert('Este usuário encontra-se DESABILITADO. Favor entrar em contato com o administrador.');
			window.location.href = '{{ route("sair") }}';
		};
	</script>
</head>
<body>
	<p>Você será redirecionado automaticamente!</p>
</body>
</html>
