<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Leitor de QR code</title>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.min.js"></script>
</head>
<body>
    <button onclick="abrirCamera()">Abrir câmera</button>
    <div id="qr-code-result"></div>
    <video id="video" width="320" height="240" style="display:none"></video>
    <canvas id="canvas" width="320" height="240" style="display:none"></canvas>
    <script>
        function abrirCamera() {
            var video = document.getElementById('video');
            var canvas = document.getElementById('canvas');
            var qrCodeResult = document.getElementById('qr-code-result');
            
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                video.srcObject = stream;
                video.play();
                
                requestAnimationFrame(function() {
                    desenharImagem(video, canvas);
                    decodificarQRCode(canvas, qrCodeResult);
                });
            }).catch(function(err) {
                console.error(err);
            });
        }
        
        function desenharImagem(video, canvas) {
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
        }
        
        function decodificarQRCode(canvas, qrCodeResult) {
            var context = canvas.getContext('2d');
            var imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            var codigoQR = jsQR(imageData.data, imageData.width, imageData.height);
            
            if (codigoQR) {
                qrCodeResult.innerHTML = 'Resultado: ' + codigoQR.data;
            }
            
            requestAnimationFrame(function() {
                decodificarQRCode(canvas, qrCodeResult);
            });
        }
    </script>
</body>
</html>