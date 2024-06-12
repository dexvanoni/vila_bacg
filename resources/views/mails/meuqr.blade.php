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
         border-color: #00f #00f #00f #00f; /* cores: topo, direita, inferior, esquerda */
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
                {!! QrCode::size(250)->generate($usuarios->cpf) !!}
            </div>
                <p style="font-size: 12px;"><strong>Nome:</strong> {{$usuarios->name}}</p>
                <p style="font-size: 12px;"><strong>Data de Nascimento:</strong> {{date('d/m/Y', strtotime($usuarios->nascimento))}}</p>
                <p style="font-size: 12px;"><strong>CPF:</strong> {{ $usuarios->cpf }}</p>
                <p style="font-size: 12px;"><strong>Local de Acesso:</strong> {{ $usuarios->local }}</p>
                <p style="font-size: 9px;">Apresentar este cartão no leitor de QR-Code na portaria para entrada na Vila da Base Aérea</p>
    </div>
</body>
</html>
