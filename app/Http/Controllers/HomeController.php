<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aviso;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            if (Auth::user()->status == 0) {
                return redirect()
                    ->route('alert');                    
            } else {
                $avisos = Aviso::all();
                return view('home', compact('avisos'));    
            }
            
    
    }

    public function lista()
    {
        $lista = User::all();
        return view('usuarios.lista', compact('lista'));
    }
}
    