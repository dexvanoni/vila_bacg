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
				<div class="card-header" style="background-color: #FF6E47;">CADASTRO NÃO REALIZADO!</div>
				<div class="container text-center">
					<h4 style="color: red;">CPF DUPLICADO</h4>
					<p>Este CPF já existe no <strong>SisVila</strong> .</p>
					<p>Clique em  <button onclick="history.back()">Voltar</button> para ser redirecionado para voltar ao formulário de cadastro!</p>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script>
  document.getElementById("backBtn").addEventListener("click", function(){
    history.back();
  });
</script>
@endsection