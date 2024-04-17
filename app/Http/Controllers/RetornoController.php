<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetornoController extends Controller
{
    public function leitura(Request $request){
            dd($request->input('mov'));
    }
}
