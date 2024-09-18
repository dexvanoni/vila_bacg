<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR-Code SisVila</title>
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
                {!! QrCode::size(250)->generate($convidado->doc) !!}
            </div>
                <p style="font-size: 12px;"><strong>Nome:</strong> {{$convidado->nome_completo}}</p>
                <p style="font-size: 12px;"><strong>Evento:</strong> {{$convidado->lista}} ({{$convidado->destino}})</p>
                <p style="font-size: 13px; color: white; background-color: red; text-align: center;"><strong>Validade:</strong> {{date('d/m/Y', strtotime($convidado->dt_entrada))}} {{date('H:i', strtotime($convidado->hr_entrada))}} <br>até <br> {{date('d/m/Y', strtotime($convidado->dt_saida))}} {{date('H:i', strtotime($convidado->hr_saida))}}</p>
                @php
                    $liberador = App\User::find($convidado->onesignal_id);
                @endphp
                <p style="font-size: 12px;"><strong>Autorizado por:</strong> {{$liberador->name}}</p>
                <p style="font-size: 12px;"><strong>Contato Liberador:</strong> {{$liberador->telefone}}</p>
                <p style="font-size: 9px;">Apresentar este cartão no leitor de QR-Code na portaria para entrada na Vila da Base Aérea</p>
    </div>
</body>
</html>
