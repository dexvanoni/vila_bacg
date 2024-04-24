@extends('layouts.app')

@section('style_morador')
body {
    background-color: #e6e6e6; /* Cinza claro */
}
.custom-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.custom-box {
    background-color: #ffffff; /* Branco */
    border-radius: 10px; /* Bordas arredondadas */
    padding: 20px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.3); /* Sombra */
}

.custom-button {
      width: 300px; /* Largura do botão */
      height: 80px; /* Altura do botão */
      display: flex; /* Usando Flexbox */
      flex-direction: column; /* Ícone em cima, texto embaixo */
      align-items: center; /* Centraliza o conteúdo horizontalmente */
      justify-content: center; /* Centraliza o conteúdo verticalmente */
      border: 1px solid #ccc; /* Borda para parecer botão */
      border-radius: 10px; /* Cantos arredondados */
      background-color: #f8f9fa; /* Cor de fundo */
      color: #333; /* Cor do texto */
      text-decoration: none; /* Remove sublinhado */
      transition: background-color 0.2s; /* Animação ao hover */
    }

    .custom-button i {
      font-size: 24px; /* Tamanho do ícone */
      margin-bottom: 5px; /* Espaço entre ícone e texto */
    }

    .custom-button:hover {
      background-color: #e2e6ea; /* Cor ao passar o mouse */
    }

    .button-column {
      display: flex; /* Usando Flexbox */
      flex-direction: column; /* Colocar botões um embaixo do outro */
      gap: 5px; /* Espaço entre botões */
    }

@endsection

@section('content')
<div class="container">
   <!-- SELEÇÃO DE TIPO DE USUÁRIO-->
   <div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="custom-container">
                <div class="custom-box">
                    <h5>Selecione o tipo de usuário a ser cadastrado</h5>
                    <hr>
                         <div class="container mt-5 d-flex justify-content-center">
                            <div class="button-column">
                              <!--<a class="custom-button" href="{{ route('register', ['param' => 'ad']) }}" style="background-color: red; color: white;">
                                <i class="fas fa-user-shield"></i> 
                                <span>Administrador</span>
                              </a>-->

                              <a class="custom-button" href="{{ route('register', ['param' => 'mo']) }}" style="background-color: green; color: white;">
                                <i class="fas fa-home"></i> <!-- Ícone para Morador -->
                                <span>Morador</span>
                              </a>

                              <a class="custom-button" href="{{ route('register', ['param' => 'po']) }}" style="background-color: yellow;">
                                <i class="fas fa-building"></i> <!-- Ícone para Portaria -->
                                <span>Portaria</span>
                              </a>

                              <a class="custom-button" href="{{ route('register', ['param' => 'so']) }}" style="background-color: blue; color: white;">
                                <i class="fas fa-umbrella-beach"></i> <!-- Ícone para Sócio -->
                                <span>Sócio das Áreas de Lazer</span>
                              </a>

                              <a class="custom-button" href="{{ route('register', ['param' => 'ra']) }}" style="background-color: black; color: white;">
                                <i class="fas fa-user-tie"></i> <!-- Ícone para Responsável por Aluno -->
                                <span>Responsável por Aluno</span>
                              </a>

                              <a class="custom-button" href="{{ route('register', ['param' => 'al']) }}" style="background-color: burlywood; color: white;">
                                <i class="fas fa-user-graduate"></i> <!-- Ícone para Aluno -->
                                <span>Aluno Escola/EMEI</span>
                              </a>

                              <a class="custom-button" href="{{ route('register', ['param' => 'fe']) }}" style="background-color: grey; color: white;">
                                <i class="fas fa-graduation-cap"></i> <!-- Ícone para Funcionário Escola/IMEI -->
                                <span>Funcionário Escola/EMEI</span>
                              </a>

                              <a class="custom-button" href="{{ route('register', ['param' => 'ef']) }}" style="background-color: cadetblue; color: white;">
                                <i class="fas fa-user-shield"></i> <!-- Ícone para Efetivo BACG -->
                                <span>Efetivo BACG</span><span style="font-size: 9px;">Não sócio/Não morador</span>
                              </a>
                            </div>
                          </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
