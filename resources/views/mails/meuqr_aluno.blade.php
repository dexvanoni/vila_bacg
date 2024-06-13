<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Impressão de QR-Code</title>
    <style type="text/css">
        .cartao {
         width:250px;
         height:580px;
         border: 8px solid; /* As 4 bordas sólidas com 25px de espessura */
         border-color: #b6f542 #b6f542 #b6f542 #b6f542; /* cores: topo, direita, inferior, esquerda */
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
                {!! QrCode::size(250)->generate($alunos->cpf_resp) !!}
            </div>
                <p style="font-size: 12px;"><strong>Nome:</strong> {{$alunos->nome_aluno}}</p>
                <p style="font-size: 12px;"><strong>CPF:</strong> {{ $alunos->cpf_aluno }}</p>
                <p style="font-size: 12px;"><strong>Local de Acesso:</strong> {{ $alunos->local_aluno }}</p>
                <p style="font-size: 9px;">Apresentar este cartão no leitor de QR-Code na portaria para entrada na Vila da Base Aérea</p>
    </div>
</body>
</html>
