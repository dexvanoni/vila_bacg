<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/retorno/{qrcode}/{mov}', function ($qrcode, $mov) {
    $qr = $qrcode;
    $mov = $mov;
// Realiza a busca de usuário no banco de dados, utilizando o qrcode como filtros
    $pessoa = DB::table('users')->where('id', '=', $qr)->first();
    if (!is_null($pessoa)) {
        if ($pessoa->status == 1) {
                    //NESTE LUGAR INSERIR NA TABELA A MOVIMENTAÇÃO DO MORADOR
            App\Movimentacao::create(['morador_id' => $qr, 'movimento' => 'ENTRADA']);
                    // Retorna a lista de usuários no formato JSON
            return response()->json(['qrcode' => $qr, 'movimentacao' => $mov]);
        }else{
            return redirect()->back()->with('neg', 'Entrada NÃO AUTORIZADA!');
        };
    }else{
        return redirect()->back()->with('neg', 'Usuário não encontrado! Entrada NÃO AUTORIZADA!');
    };

});