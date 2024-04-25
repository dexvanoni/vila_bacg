@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<img src="imagens/sisvila2.png" width="200px" height="200px">
	</div>
	<hr>
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header" style="background-color: #BEFFB6;">Sucesso!</div>
				<div class="container text-center">
					<h4 style="color: green;">Cadastro realizado!</h4>
					<p>Você acabou de realizar o seu cadastro no <strong>SisVila</strong> .</p>
					<p>Aguarde o email de confirmação do Administrador para realizar o seu login e começar a utilizar nossas ferramentas.</p>
					<p><a href="http://www.vilabacg.com.br">Clique aqui</a> para ser redirecionado para o SisVila!</p>
				</div>
				
			</div>
		</div>
	</div>
</div>
@endsection