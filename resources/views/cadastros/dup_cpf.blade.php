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
				<div class="container">
					<h4 class="text-center" style="color: red;">PROBLEMAS NA DIGITAÇÃO DO CPF</h4>
					<hr>
					<p>Erros encontrados: </p>
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
					<hr>
					<p><button class="btn-warning" onclick="history.back()">Clique aqui</button> para ser redirecionado para voltar ao formulário de cadastro!</p>
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