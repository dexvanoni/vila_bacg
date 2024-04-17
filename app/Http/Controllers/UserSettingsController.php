<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;

class UserSettingsController extends Controller
{
     public function update(Request $request)
    {
        //dd($request);
        //exit;
        
        $user = Auth::user(); // resgata o usuario
        $user->password = bcrypt($request->password); // muda a senha do seu usuario já criptografada pela função bcrypt
        $user->save(); // salva o usuario alterado =)

       return redirect()
                    ->route('home')
                    ->with('success', 'Senha alterada com sucesso!');
    }

    public function create(){

        $usuario = Auth::user();
        return view('auth.passwords.alterar', compact('usuario'));
    }
}
