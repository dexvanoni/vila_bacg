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
/* MOVIMENTAÇÕES DE ENTRADA */
        if (!is_null($request->entrada)) {
            if ($request->entrada < 1000000) {
                $pessoa = DB::table('users')->where('id', '=', $request->entrada)->first();
                if (!is_null($pessoa)) {
                    if ($pessoa->status == 1) {

                        Movimentacao::create(['morador_id' => $request->entrada, 'movimento' => 'ENTRADA']);
                        Session::flash('arquivo', $pessoa->arquivo); 
                        
                        return redirect()->back()->with([
                                'success' => 'a',
                                'nome' => $pessoa->name,
                                'local' => $pessoa->local]);
                    }else{
                        return redirect()->back()->with('neg_usuario_bloqueado', 'Entrada NÃO AUTORIZADA!');
                    };
                }else{
                    return redirect()->back()->with('neg_encontrado', 'Usuário não encontrado! Entrada NÃO AUTORIZADA!');
                };
            } else {
                $now = Carbon::now();
                // Verifica se é sábado, domingo ou dia da semana entre 18h e 6h
                
                if ($now->isWeekend() || ($now->isWeekday() && ($now->hour < 6 || $now->hour >= 18))) {
                    return redirect()->back()->with('hora_neg', 'ENTRADA NÃO AUTORIZADA! Horário ou dias não permitidos para alunos ou responsáveis!');
                }
                
                $pessoa = DB::table('alunos')->where('id', '=', $request->entrada)->first();
                if (!is_null($pessoa)) {
                    if ($pessoa->status_aluno == 1) {
                        Movimentacao::create(['morador_id' => $request->entrada, 'movimento' => 'ENTRADA']);
                        if ($pessoa->tipo_aluno == 'ALUNO') {
                            Session::flash('arquivo', $pessoa->arquivo_aluno); 
                            return redirect()->back()->with([
                                'success_aluno' => 'a',
                                'nome_do_aluno' => $pessoa->nome_aluno,
                                'local_do_aluno' => $pessoa->local_aluno]);
                        }else{
                            Session::flash('arquivo', $pessoa->arquivo_resp);
                            /*Pesquisa validade da CNH*/
                            $cnh = CadAluno::select('validade_cnh_resp')->where('id', $request->entrada)->first();

                            if ($cnh) {
                                // Obtemos a data de validade da CNH
                                $validadeCNH = Carbon::createFromFormat('Y-m-d', $cnh->validade_cnh_resp);

                                // Obtemos a data atual
                                $hoje = Carbon::now();

                                // Verifica se a data de validade da CNH é anterior à data atual
                                if ($validadeCNH->isPast()) {
                                    $validade = "CNH vencida! Vencimento em: ".date('d/m/Y', strtotime($validadeCNH));
                                } else {
                                    $validade = "A CNH do usuário está válida.";
                                }
                            } else {
                                $validade = "Este usuario nao possui CNH cadastrada. Verificar em caso de CONDUTOR de veiculos!";
                            }

                            return redirect()->back()->with([
                                'success_resp' => 'a',
                                'nome_do_resp' => $pessoa->nome_resp,
                                'resp_do_aluno' => $pessoa->nome_aluno_resp,
                                'carteira' => $validade
                            ]);
                        }

                    }else{
                        return redirect()->back()->with('neg_usuario_bloqueado', 'Entrada NÃO AUTORIZADA! Usuario com STATUS "Desabilitado" no sistema.');
                    };
                }else{
                    return redirect()->back()->with('neg_encontrado', 'Usuário não encontrado! Entrada NÃO AUTORIZADA!');
                };
            }
            
        };
        
        /* MOVIMENTAÇÕES DE SAÍDA */

        if (!is_null($request->saida)) {


            if ($request->saida < 1000000) {
                $pessoa = DB::table('users')->where('id', '=', $request->saida)->first();
                if (!is_null($pessoa)) {
                    if ($pessoa->status == 1) {

                            //NESTE LUGAR INSERIR NA TABELA A MOVIMENTAÇÃO DO MORADOR
                            //DB::table('movimentacao')->insert(['morador_id' => $request->saida, 'movimento' => 'SAÍDA']);
                        Movimentacao::create(['morador_id' => $request->saida, 'movimento' => 'SAÍDA']);
                        Session::flash('arquivo', $pessoa->arquivo); 
                        
                        return redirect()->back()->with([
                                'sai_success' => 'a',
                                'nome' => $pessoa->name,
                                'local' => $pessoa->local]);
                    }else{
                        return redirect()->back()->with('sai_neg_usuario_bloqueado', 'Saída NÃO AUTORIZADA!');
                    };
                }else{
                    return redirect()->back()->with('sai_neg_encontrado', 'Usuário não encontrado! Saída NÃO AUTORIZADA!');
                };
            } else {
                $now = Carbon::now();
                // Verifica se é sábado, domingo ou dia da semana entre 18h e 6h
                
                if ($now->isWeekend() || ($now->isWeekday() && ($now->hour < 6 || $now->hour >= 18))) {
                    return redirect()->back()->with('sai_hora_neg', 'SAÍDA NÃO AUTORIZADA! Horário ou dias não permitidos para alunos ou responsáveis!');
                }
                
                $pessoa = DB::table('alunos')->where('id', '=', $request->saida)->first();
                if (!is_null($pessoa)) {
                    if ($pessoa->status_aluno == 1) {
                        Movimentacao::create(['morador_id' => $request->saida, 'movimento' => 'SAÍDA']);
                        if ($pessoa->tipo_aluno == 'ALUNO') {
                            Session::flash('arquivo', $pessoa->arquivo_aluno); 
                            return redirect()->back()->with([
                                'sai_success_aluno' => 'a',
                                'nome_do_aluno' => $pessoa->nome_aluno,
                                'local_do_aluno' => $pessoa->local_aluno]);
                        }else{
                            Session::flash('arquivo', $pessoa->arquivo_resp); 
                            return redirect()->back()->with([
                                'sai_success_resp' => 'a',
                                'nome_do_resp' => $pessoa->nome_resp,
                                'resp_do_aluno' => $pessoa->nome_aluno_resp]);
                        }

                    }else{
                        return redirect()->back()->with('sai_neg', 'Saída NÃO AUTORIZADA! b');
                    };
                }else{
                    return redirect()->back()->with('sai_neg', 'Usuário não encontrado! Saída NÃO AUTORIZADA!');
                };
            }
            
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
