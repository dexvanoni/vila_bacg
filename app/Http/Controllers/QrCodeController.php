<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;
use App\CadAluno;
use App\Liberar;
use App\Movimentacao;
use Dompdf\Dompdf;

class QrCodeController extends Controller
{
    public function qr_organico($usuario)
    {
        $usuario = User::find($usuario);
        return view('usuarios.print_qr', compact('usuario'));
    }

    public function qr_alunos($usuario)
    {
        $usuario = CadAluno::find($usuario);
        return view('usuarios.print_qr_alunos', compact('usuario'));
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

    public function leitor(){
        return view('leitor');
    }

    public function morador(Request $request){

        //dd($request);
        // exit;

        if (!is_null($request->entrada)) {
            $pessoa = DB::table('users')->where('id', '=', $request->entrada)->first();
            if (!is_null($pessoa)) {
                if ($pessoa->status == 1) {

                        //NESTE LUGAR INSERIR NA TABELA A MOVIMENTAÇÃO DO MORADOR
                        //DB::table('movimentacao')->insert(['morador_id' => $request->entrada, 'movimento' => 'ENTRADA']);
                    Movimentacao::create(['morador_id' => $request->entrada, 'movimento' => 'ENTRADA']);
                    Session::flash('arquivo', $pessoa->arquivo); 
                    return redirect()->back()->with('success', 'Entrada AUTORIZADA do Sr(a). ' . $pessoa->name . ' da ' . $pessoa->local . '!');
                }else{
                    return redirect()->back()->with('neg', 'Entrada NÃO AUTORIZADA!');
                };
            }else{
                return redirect()->back()->with('neg', 'Usuário não encontrado! Entrada NÃO AUTORIZADA!');
            };
        };
        
        if (!is_null($request->saida)) {
            $pessoa = DB::table('users')->where('id', '=', $request->saida)->first();
            if (!is_null($pessoa)) {
                if ($pessoa->status == 1) {
                        //NESTE LUGAR INSERIR NA TABELA A MOVIMENTAÇÃO DO MORADOR
                    Movimentacao::create(['morador_id' => $request->saida, 'movimento' => 'SAÍDA']);
                    Session::flash('arquivo', $pessoa->arquivo); 
                    return redirect()->back()->with('saida', 'Saída AUTORIZADA do Sr(a). ' . $pessoa->name . ' da ' . $pessoa->local . '!');
                }else{
                    return redirect()->back()->with('neg', 'Saída NÃO AUTORIZADA!');
                };
            }else{
                return redirect()->back()->with('neg', 'Usuário não encontrado! Saída NÃO AUTORIZADA!');
            };
        };
    }

    public function impressao(){
        $crachas = User::all();
        return view('usuarios.impressao_crachas', compact('crachas'));
    }

    public function impressao_alunos(){
        $crachas = CadAluno::all();
        return view('usuarios.impressao_crachas', compact('crachas'));
    }

}
