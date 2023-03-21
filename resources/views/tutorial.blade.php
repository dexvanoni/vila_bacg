@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tutorial de Utilização do Sistema</h1>

        <p>Bem-vindo(a) ao tutorial de utilização do nosso sistema! Aqui você vai aprender como utilizar as principais funcionalidades do sistema e tirar o máximo proveito dele.</p>

        <h2>Passo 1: Login</h2>

        <p>Para começar a utilizar o sistema, é necessário fazer login com suas credenciais. Caso não possua uma conta, clique no link "Registrar" e siga as instruções para criar uma nova conta.</p>

        <h2>Passo 2: Dashboard</h2>

        <p>Após fazer login, você será redirecionado para o dashboard, onde poderá visualizar um resumo das principais informações do sistema, bem como acessar as principais funcionalidades através do menu lateral.</p>

        <h2>Passo 3: Utilização das funcionalidades</h2>

        <p>O sistema possui diversas funcionalidades, como cadastro de clientes, pedidos, produtos, entre outras. Para utilizar cada funcionalidade, basta acessá-la através do menu lateral e seguir as instruções.</p>

        <h2>Passo 4: Ajuda</h2>

        <p>Caso tenha dúvidas ou problemas durante a utilização do sistema, consulte a seção de ajuda no menu lateral. Lá você encontrará informações sobre como utilizar cada funcionalidade, além de informações de contato para suporte.</p>

        <p>Esperamos que este tutorial tenha sido útil para você! Qualquer dúvida ou sugestão, entre em contato com nossa equipe de suporte.</p>

        <a style="padding-left: 40%;" href='{{$_SERVER['HTTP_REFERER']}}'>Voltar</a><br>
    </div>
@endsection
