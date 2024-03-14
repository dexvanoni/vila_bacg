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
        $usuario = DB::table('users')->where('cpf', '=', $usuario)->first();
        return view('usuarios.print_qr', compact('usuario'));
    }

    public function qr_alunos($usuario)
    {
        $usuario = DB::table('alunos')
            ->where('cpf_aluno', '=', $usuario)
            ->orWhere('cpf_resp', '=', $usuario)
            ->first();
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

/* MOVIMENTAÇÕES DE ENTRADA */
        if (!is_null($request->entrada)) {
            $morador = DB::table('users')->where('cpf', '=', $request->entrada)->first();
            $aluno = DB::table('alunos')->where('cpf_aluno', '=', $request->entrada)->first();
            $responsavel = DB::table('alunos')->where('cpf_resp', '=', $request->entrada)->first();

            if (is_null($morador) && is_null($aluno) && is_null($responsavel)) {
                return redirect()->back()->with('neg_encontrado', 'Entrada NÃO AUTORIZADA!');
            }

///se for morador
            if(!is_null($morador)){
               
               if ($morador->status == 1) {

                        Movimentacao::create(['morador_id' => $request->entrada, 'movimento' => 'ENTRADA']);
                        Session::flash('arquivo', $morador->arquivo); 
                        
                        return redirect()->back()->with([
                                'success' => 'a',
                                'nome' => $morador->name,
                                'local' => $morador->local]);
                    }else{
                        return redirect()->back()->with('neg_usuario_bloqueado', 'Entrada NÃO AUTORIZADA!');
                    };


            };
///se for aluno
            if(!is_null($aluno)){
                $now = Carbon::now();
                // Verifica se é sábado, domingo ou dia da semana entre 18h e 6h
                
                /*if ($now->isWeekend() || ($now->isWeekday() && ($now->hour < 6 || $now->hour >= 19))) {
                    return redirect()->back()->with('hora_neg', 'ENTRADA NÃO AUTORIZADA! Horário ou dias não permitidos para alunos ou responsáveis!');
                }*/

                if ($aluno->status_aluno == 1) {
                        Movimentacao::create(['morador_id' => $request->entrada, 'movimento' => 'ENTRADA']);
                        
                            Session::flash('arquivo', $aluno->arquivo_aluno); 
                            return redirect()->back()->with([
                                'success_aluno' => 'a',
                                'nome_do_aluno' => $aluno->nome_aluno,
                                'local_do_aluno' => $aluno->local_aluno]);
                        
                }else{
                    return redirect()->back()->with('neg_usuario_bloqueado', 'Entrada NÃO AUTORIZADA! Usuario com STATUS "Desabilitado" no sistema.');
                };
                
                
            };
///se for responsável
            if (!is_null($responsavel)) {

                $now = Carbon::now();
                // Verifica se é sábado, domingo ou dia da semana entre 18h e 6h
                
                /*if ($now->isWeekend() || ($now->isWeekday() && ($now->hour < 6 || $now->hour >= 19))) {
                    return redirect()->back()->with('hora_neg', 'ENTRADA NÃO AUTORIZADA! Horário ou dias não permitidos para alunos ou responsáveis!');
                }*/

                if ($responsavel->status_aluno == 1) {
                        Movimentacao::create(['morador_id' => $request->entrada, 'movimento' => 'ENTRADA']);
                        
                        Session::flash('arquivo', $responsavel->arquivo_resp);
                            /*Pesquisa validade da CNH*/
                            $cnh = DB::table('alunos')
                                ->where('cpf_resp', $responsavel->cpf_resp)
                                ->whereNotNull('validade_cnh_resp')
                                ->get();

                            if ($cnh->isNotEmpty()) {
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
                                $validade = "Este usuario nao possui CNH ou validade da mesma nao esta cadastrada. Verificar em caso de CONDUTOR de veiculos!";
                            }

                            return redirect()->back()->with([
                                'success_resp' => 'a',
                                'nome_do_resp' => $responsavel->nome_resp,
                                'resp_do_aluno' => $responsavel->nome_aluno_resp,
                                'carteira' => $validade
                            ]);
                        
                }else{
                    return redirect()->back()->with('neg_usuario_bloqueado', 'Entrada NÃO AUTORIZADA! Usuario com STATUS "Desabilitado" no sistema.');
                };
            };

    };
        
/* MOVIMENTAÇÕES DE ENTRADA */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* MOVIMENTAÇÕES DE SAÍDA */
if (!is_null($request->saida)) {
            $morador = DB::table('users')->where('cpf', '=', $request->saida)->first();
            $aluno = DB::table('alunos')->where('cpf_aluno', '=', $request->saida)->first();
            $responsavel = DB::table('alunos')->where('cpf_resp', '=', $request->saida)->first();

            if (is_null($morador) && is_null($aluno) && is_null($responsavel)) {
                return redirect()->back()->with('neg_encontrado', 'Entrada NÃO AUTORIZADA!');
            }
///se for morador
            if(!is_null($morador)){
               
               if ($morador->status == 1) {

                        Movimentacao::create(['morador_id' => $request->saida, 'movimento' => 'SAÍDA']);
                        Session::flash('arquivo', $morador->arquivo); 
                        
                        return redirect()->back()->with([
                                'sai_success' => 'a',
                                'nome' => $morador->name,
                                'local' => $morador->local]);
                    }else{
                        return redirect()->back()->with('sai_neg_usuario_bloqueado', 'Entrada NÃO AUTORIZADA!');
                    };


            };
///se for aluno
            if(!is_null($aluno)){
                $now = Carbon::now();
                // Verifica se é sábado, domingo ou dia da semana entre 18h e 6h
                
                /*if ($now->isWeekend() || ($now->isWeekday() && ($now->hour < 6 || $now->hour >= 19))) {
                    return redirect()->back()->with('hora_neg', 'SAÍDA NÃO AUTORIZADA! Horário ou dias não permitidos para alunos ou responsáveis!');
                }*/

                if ($aluno->status_aluno == 1) {
                        Movimentacao::create(['morador_id' => $request->saida, 'movimento' => 'SAÍDA']);
                        
                            Session::flash('arquivo', $aluno->arquivo_aluno); 
                            return redirect()->back()->with([
                                'sai_success_aluno' => 'a',
                                'nome_do_aluno' => $aluno->nome_aluno,
                                'local_do_aluno' => $aluno->local_aluno]);
                        
                }else{
                    return redirect()->back()->with('sai_neg_usuario_bloqueado', 'Entrada NÃO AUTORIZADA! Usuario com STATUS "Desabilitado" no sistema.');
                };
                
                
            };
///se for responsável
            if (!is_null($responsavel)) {

                $now = Carbon::now();
                // Verifica se é sábado, domingo ou dia da semana entre 18h e 6h
                
                /*if ($now->isWeekend() || ($now->isWeekday() && ($now->hour < 6 || $now->hour >= 19))) {
                    return redirect()->back()->with('hora_neg', 'SAÍDA NÃO AUTORIZADA! Horário ou dias não permitidos para alunos ou responsáveis!');
                }*/

                if ($responsavel->status_aluno == 1) {
                        Movimentacao::create(['morador_id' => $request->saida, 'movimento' => 'SAÍDA']);
                        
                        Session::flash('arquivo', $responsavel->arquivo_resp);
                            /*Pesquisa validade da CNH*/
                            $cnh = DB::table('alunos')
                                ->where('cpf_resp', $responsavel->cpf_resp)
                                ->whereNotNull('validade_cnh_resp')
                                ->get();

                            if ($cnh->isNotEmpty()) {
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
                                'sai_success_resp' => 'a',
                                'nome_do_resp' => $responsavel->nome_resp,
                                'resp_do_aluno' => $responsavel->nome_aluno_resp,
                                'carteira' => $validade
                            ]);
                        
                }else{
                    return redirect()->back()->with('neg_usuario_bloqueado', 'Entrada NÃO AUTORIZADA! Usuario com STATUS "Desabilitado" no sistema.');
                };
            }
        }

    }

/* MOVIMENTAÇÕES DE SAÍDA */

    public function impressao(){
        $crachas = User::all();
        return view('usuarios.impressao_crachas', compact('crachas'));
    }

    public function impressao_alunos(){
        $crachas = CadAluno::all();
        return view('usuarios.impressao_crachas', compact('crachas'));
    }

}
