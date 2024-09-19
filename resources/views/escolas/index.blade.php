@extends('layouts.app')
@section('cad_morador')
/* Borda fina e cinza com cantos arredondados para imagens do grid específico */
.bordered-image {
  border: 1px solid #cccccc; /* Borda cinza */
  border-radius: 10px; /* Cantos arredondados */
}

/* Borda fina e cinza com cantos arredondados para linhas do grid específico */
.bordered-row {
  border: 1px solid #cccccc; /* Borda cinza */
  border-radius: 10px; /* Cantos arredondados */
  padding: 10px; /* Adicionar espaçamento interno */
}

.img-container {
    position: relative;
    margin-bottom: 20px; /* Adicione margem entre as imagens */
}

.img-zoom-result {
    border: 1px solid #d4d4d4;
    width: 400px;
    height: 400px;
    position: absolute;
    top: 0;
    left: 300px;
    display: none;
    overflow: hidden;
    background-repeat: no-repeat;
    z-index: 1000;
}

.img-zoom-lens {
    position: absolute;
    width: 100px;
    height: 100px;
    cursor: none;
}

.btn-custom-size {
    padding: 10px 20px;
    font-size: 16px;
    width: 170px; /* largura fixa */
    text-align: center; /* centralizar texto */
}

@media (max-width: 768px) {
    .btn-custom-size {
        padding: 8px 16px;
        font-size: 14px;
        width: 150px; /* largura ajustada para telas menores */
    }
}

@media (max-width: 576px) {
    .btn-custom-size {
        padding: 6px 12px;
        font-size: 12px;
        width: 100px; /* largura ajustada para telas ainda menores */
    }
}
@endsection
@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="100px" height="100px">        
        </div>
        <div class="col-md-10">
            <h2>Email Funcional da Escola e da EMEI</h2><br>
            <h5>Neste email são enviados os crachás dos alunos para as Instituições.</h5>
        </div>
    </div>
    <hr>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    <hr>
    @endif
    @if(session('update'))
    <div class="alert alert-success" role="alert">
        {{ session('update') }}
    </div>
    <hr>
    @endif
    @if(session('erro'))
    <div class="alert alert-danger" role="alert">
        {{ session('erro') }}
    </div>
    <hr>
    @endif
    <form action="{{ route('escolas.update', ['id' => $emails[0]->id])}}" method="POST" id="update-form">
        @csrf
        @method('PUT')

                <div class="form-group row">
                    <label for="escola" class="col-4 col-form-label">Escola Y-Juca Pirama</label>
                    <div class="col">
                      <input type="email" class="form-control" name="escola" value="{{ $emails[0]->escola }}">
                  </div>
              </div>


            <div class="form-group row">
                <label for="emei" class="col-4 col-form-label">EMEI Prof. Maria Josefina</label>
                <div class="col">
                  <input type="email" class="form-control" name="emei" value="{{ $emails[0]->emei }}">
              </div>
          </div>

      <div class="row ">
        <div class="col-md-2">
            <div class="form-group">
                <label for=""></label>
                <button type="submit" class="btn btn-primary" onclick="confirmUpdate(event)">
                    Atualizar
                </button>
            </div>
        </div>
    </div>


</form>

</div>

<script>
    function confirmUpdate(event) {
    event.preventDefault(); // Impede a submissão imediata do formulário
    if (confirm('Você tem certeza que deseja atualizar as informações?')) {
        document.getElementById('update-form').submit(); // Submete o formulário se o usuário confirmar
    }
}
</script>
@endsection