@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;

    async function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            
            // Handle on success condition with the decoded message.
            //console.log(`Scan result ${decodedText}`, decodedResult);
            //alert(decodedText);


            fetch('/process_qr', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    variavelDoJS: decodedText
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manipula os dados recebidos, exibe no console
                console.log(data.mensagem);

                // Exibe a mensagem em um alert
//                //alert(data.mensagem);

                // Redireciona para a view desejada
                //window.location.href = '/sua-view';
            })
            .catch(error => console.error('Erro na solicitação fetch: ', error));

            //$('#qr-reader-results').prepend("<p>" + decodedText + "</p>");
        }
    }
    setTimeout(function(){
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);

    },500);  

    function waitme(){
        promise1=new Promise(function(resolve){

            setTimeout(function(){

                resolve('ok');
            },1000)
        })

        return promise1;

    }

    window.addEventListener('beforeunload', function (e) {
          // Cancel the event
          e.preventDefault();
          // Chrome requires returnValue to be set
          e.returnValue = '3';
      });
  </script>
  <div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h4>Leitor de QR Code</h4>
                    <hr>
                    <div id="qr-reader" style="width:310px"></div>
                    <h3>Último QR-Code lido: </h3><div id="qr-reader-results"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>

@endsection