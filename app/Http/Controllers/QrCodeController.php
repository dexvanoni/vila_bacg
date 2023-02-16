<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function qrcode_organico($usuario)
    {
      //não funcionando. O QRCode vai aparecer em uma modal na tela de lista de usuários.
      return view('qrcode');
    }
}
