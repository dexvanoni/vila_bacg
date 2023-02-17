<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;

class QrCodeController extends Controller
{
    public function qr_organico($usuario)
    {
        $usuario = User::find($usuario);
      return view('usuarios.print_qr', compact('usuario'));
    }
}
