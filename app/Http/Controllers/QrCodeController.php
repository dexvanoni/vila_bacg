<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;
use App\Liberar;

class QrCodeController extends Controller
{
    public function qr_organico($usuario)
    {
        $usuario = User::find($usuario);
      return view('usuarios.print_qr', compact('usuario'));
    }


    public function qr_convidado($convidado)
    {
        $convidado = Liberar::find($convidado);
        return view('usuarios.print_qr_conv', compact('convidado'));
        
    }

    public function qr_whats($convidado)
    {
        //envia qr para whatsapp do convidado
        
        return redirect()->back()->with('success', 'QR-Code enviado com sucesso!');   

    }
}
