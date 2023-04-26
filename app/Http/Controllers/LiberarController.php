<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Liberar;
use Auth;
use Carbon\Carbon;

use Maatwebsite\Excel\Excel as ExcelExcel;

use App\Imports\VisitanteImport;
use Maatwebsite\Excel\Facades\Excel;

class LiberarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function import(Request $request)
    {

       // importação da lista de convidados junto com insputs do formulário.
        // vai para o controller VisitanteController

       Excel::import(new VisitanteImport($request->lista, $request->destino, $request->observacao, $request->dt_entrada, $request->hr_entrada, $request->dt_saida, $request->hr_saida, $request->status), $request->file('arquivo'));

       // gerar qrcode de cada convidado

       

       // envio do qr-code para cada convidado que tenha celular com whats cadastrado na lista

       
       return redirect()
                    ->route('lista_ingresso.include_external_user_ids')
                    ->with('success', 'Convidados liberados. Bom evento!!');
    }

    public function index()
    {
          $perfis = collect([]);
              foreach(explode(',',  Auth::user()->autorizacao) as $info){
                if ($info == 'pe') {
                  $perfis->push('Permissionário');
                } elseif ($info == 'de') {
                  $perfis->push('Dependente');
                } elseif ($info == 'st') {
                  $perfis->push('Sócio-Titular');
                } elseif ($info == 'sd') {
                  $perfis->push('Sócio-Dependente');
                } elseif ($info == 'fe') {
                  $perfis->push('Funcionário da Escola');
                } elseif ($info == 'ra') {
                  $perfis->push('Responsável por Aluno');
                } elseif ($info == 'ps') {
                  $perfis->push('Prestador de Serviço');
                } elseif ($info == 'po') {
                  $perfis->push('Portaria');
                } elseif ($info == 'si') {
                  $perfis->push('Síndico');
                } elseif ($info == 'ad') {
                  $perfis->push('Administrador');
                }
                $perfis->all();
              };
         if ($perfis->contains('Administrador') || $perfis->contains('Portaria')){
            $liberacoes_entradas = DB::table('cad_vis_entrada')->where('movimentacao', 'A')->orderBy('movimentacao')->get();
            $liberacoes_saidas = DB::table('cad_vis_entrada')->where('movimentacao', 'E')->orderBy('movimentacao')->get();
            $liberacoes_completas = DB::table('cad_vis_entrada')->where('movimentacao', 'S')->orderBy('movimentacao')->get();
         } else {
            $liberacoes_entradas = DB::table('cad_vis_entrada')->where('onesignal_id', Auth::user()->id && 'movimentacao', 'A')->orderBy('movimentacao')->get();
            $liberacoes_saidas = DB::table('cad_vis_entrada')->where('onesignal_id', Auth::user()->id && 'movimentacao', 'E')->orderBy('movimentacao')->get();
            $liberacoes_completas = DB::table('cad_vis_entrada')->where('onesignal_id', Auth::user()->id && 'movimentacao', 'S')->orderBy('movimentacao')->get();
         };
     
        return view('liberar.index', compact('liberacoes_entradas', 'liberacoes_saidas', 'liberacoes_completas'));
    }

    public function completas()
    {

        $perfis = collect([]);
              foreach(explode(',',  Auth::user()->autorizacao) as $info){
                if ($info == 'pe') {
                  $perfis->push('Permissionário');
                } elseif ($info == 'de') {
                  $perfis->push('Dependente');
                } elseif ($info == 'st') {
                  $perfis->push('Sócio-Titular');
                } elseif ($info == 'sd') {
                  $perfis->push('Sócio-Dependente');
                } elseif ($info == 'fe') {
                  $perfis->push('Funcionário da Escola');
                } elseif ($info == 'ra') {
                  $perfis->push('Responsável por Aluno');
                } elseif ($info == 'ps') {
                  $perfis->push('Prestador de Serviço');
                } elseif ($info == 'po') {
                  $perfis->push('Portaria');
                } elseif ($info == 'si') {
                  $perfis->push('Síndico');
                } elseif ($info == 'ad') {
                  $perfis->push('Administrador');
                }
                $perfis->all();
              };
         if ($perfis->contains('Administrador') || $perfis->contains('Portaria')){
            $liberacoes_completas = DB::table('cad_vis_entrada')->where('movimentacao', 'S')->orderBy('id', 'desc')->paginate(5);
         } else {
            $liberacoes_completas = DB::table('cad_vis_entrada')->where([
                ['onesignal_id', Auth::user()->id],
                ['movimentacao', 'S']
            ])->orderBy('movimentacao', 'asc')->paginate(5);
         };
     
       return view('liberar.completas', compact('liberacoes_completas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visitantes = collect(Liberar::where('liberador', Auth::user()->name)->get());

        $visita = $visitantes->unique('apelido');

        $visita->values()->all();

        return view('liberar.liberacao', compact('visita'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // FUNÇÕES PARA LIBERAÇÃO DE VISITANTES

    public function novo(Request $request)
    {

        $onesignal_id = DB::table('cad_vis_entrada')->insertGetId([
          'apelido' => $request->apelido,
          'nome_completo' => $request->nome_completo,
          'doc' => $request->doc,
          'funcao' => $request->funcao,
          'veiculo' => $request->veiculo,
          'cor_veiculo' => $request->cor_veiculo,
          'liberador' => Auth::user()->name,
          'destino' => Auth::user()->local,
          'dt_entrada' => $request->dt_entrada,
          'dt_saida' => $request->dt_saida,
          'hr_entrada' => $request->hr_entrada,
          'hr_saida' => $request->hr_saida,
          'status' => $request->status,
          'observacao' => $request->observacao,
          'onesignal_id' => Auth::user()->id,
          'movimentacao' => 'A'
        ]);



        //ENVIAR QR-CODE do visitante para email do liberador
    
        return redirect()
                    ->route('email_qrcode', $onesignal_id);
    }

    public function anterior(Request $request)
    {
    
        $visitante = Liberar::where('apelido', '=', $request->apelido)->first();

        $anteriores = Liberar::create([
          'apelido' => $request->apelido,
          'nome_completo' => $visitante->nome_completo,
          'doc' => $visitante->doc,
          'funcao' => $visitante->funcao,
          'veiculo' => $visitante->veiculo,
          'cor_veiculo' => $visitante->cor_veiculo,
          'liberador' => Auth::user()->name,
          'destino' => Auth::user()->local,
          'dt_entrada' => $request->dt_entrada,
          'dt_saida' => $request->dt_saida,
          'hr_entrada' => $request->hr_entrada,
          'hr_saida' => $request->hr_saida,
          'status' => $request->status,
          'observacao' => $request->observacao,
          'onesignal_id' => Auth::user()->id,
          'movimentacao' => 'A'
        ]);
        
        return redirect()
                    ->route('home')
                    ->with('success', 'Visitante liberado novamente!');

    }

    public function transporte(Request $request)    
    {

        $transporte = Liberar::create([
          'apelido' => $request->apelido,
          'nome_completo' => $request->apelido,
          'doc' => 'Sem função',
          'funcao' => 'Motorista',
          'veiculo' => 'Particular',
          'cor_veiculo' => 'Sem função',
          'liberador' => Auth::user()->name,
          'destino' => Auth::user()->local,
          'dt_entrada' => $request->dt_entrada,
          'dt_saida' => $request->dt_saida,
          'hr_entrada' => $request->hr_entrada,
          'hr_saida' => $request->hr_saida,
          'status' => $request->status,
          'observacao' => $request->observacao,
          'onesignal_id' => Auth::user()->id,
          'movimentacao' => 'A'
        ]);
        
        return redirect()
                    ->route('home')
                    ->with('success', 'Motorista cadastrado com sucesso!');
    }

    public function entregador(Request $request)
    {

        $entregador = Liberar::create([
          'apelido' => $request->apelido,
          'nome_completo' => $request->apelido,
          'doc' => 'Sem função',
          'funcao' => 'Entregador',
          'veiculo' => 'Particular',
          'cor_veiculo' => 'Sem função',
          'liberador' => Auth::user()->name,
          'destino' => Auth::user()->local,
          'dt_entrada' => $request->dt_entrada,
          'dt_saida' => $request->dt_saida,
          'hr_entrada' => $request->hr_entrada,
          'hr_saida' => $request->hr_saida,
          'status' => $request->status,
          'observacao' => $request->observacao,
          'onesignal_id' => Auth::user()->id,
          'movimentacao' => 'A'
        ]);
        
        return redirect()
                    ->route('home')
                    ->with('success', 'Motorista cadastrado com sucesso!');
    }

    public function convidado(Request $request)
    {
        $onesignal_id = DB::table('cad_vis_entrada')->insertGetId([
          'apelido' => $request->nome_completo,
          'nome_completo' => $request->nome_completo,
          'doc' => 'Sem função',
          'funcao' => 'Convidado de Evento',
          'veiculo' => $request->veiculo,
          'cor_veiculo' => $request->cor_veiculo,
          'liberador' => Auth::user()->name,
          'destino' => $request->destino,
          'dt_entrada' => $request->dt_entrada,
          'dt_saida' => $request->dt_saida,
          'hr_entrada' => $request->hr_entrada,
          'hr_saida' => $request->hr_saida,
          'status' => $request->status,
          'observacao' => $request->observacao,
          'onesignal_id' => Auth::user()->id,
          'movimentacao' => 'A'
        ]);

    
        //ENVIAR QR-CODE do visitante para email do liberador
    
        return redirect()
                    ->route('email_qrcode', $onesignal_id);

    }


    //FIM DAS FUNÇÕES DE LIBERAÇÃO DE VISITANTES

    public function notificar_entrada($onesignal, $id)
    {

        // ATUALIZA A TABELA EM DATA E HORA DE ENTRADA E ATUALIZA A COLUNA "movimentacao" PARA "E"
        $dt_entrou = Carbon::now()->format('Y-m-d');
        $hr_entrou = Carbon::now()->format('H:i');

        DB::table('cad_vis_entrada')
            ->where('id', $id)
                ->update([
                    'movimentacao' => 'E', 
                    'dt_entrou' => $dt_entrou,
                    'hr_entrou' => $hr_entrou,
                ]);

        //ENVIO DA NOTIFICAÇÃO QUANDO ENTRA O VISITANTE NA PORTARIA
        $visitante = Liberar::where([
            ['onesignal_id', '=', $onesignal],
            ['id', '=', $id],
        ])->first();
        
        $content = array(
            "en" => 'O visitante '.$visitante->apelido.' acabou de ENTRAR na Vila da Base!'
            );
        
        $fields = array(
            //'app_id' => "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
            'app_id' => "ad2874e6-498f-466d-9080-579bc4df315d",
            'include_external_user_ids' => array($onesignal),
            'channel_for_external_user_ids' => 'push',
            'data' => array("foo" => "bar"),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        //                                           'Authorization: Basic YWIxMDQwNjgtMDFmZS00YmUxLWI1YjMtYzBkYTRjNjg2MTRl'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic YjIxMjkzMzEtMzNkMy00YTRiLWJkYTgtNWVjOWIxOGU1Zjlm'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        //echo 'a';
        
        //return $response;

        //$response = sendMessage();

        //TÉRMINO DE ENVIO DA NOTIFICAÇÃO QUANDO ENTRA O VISITANTE NA PORTARIA
        return redirect()
                    ->route('liberacao.index')
                    ->with('success', 'Entrada do visitante confirmada!');
    }

     public function notificar_saida($onesignal, $id){

          // ATUALIZA A TABELA EM DATA E HORA DE ENTRADA E ATUALIZA A COLUNA "movimentacao" PARA "E"
        $dt_saiu = Carbon::now()->format('Y-m-d');
        $hr_saiu = Carbon::now()->format('H:i');

        DB::table('cad_vis_entrada')
            ->where('id', $id)
                ->update([
                    'movimentacao' => 'S', 
                    'dt_saiu' => $dt_saiu,
                    'hr_saiu' => $hr_saiu,
                ]);

        //ENVIO DA NOTIFICAÇÃO QUANDO ENTRA O VISITANTE NA PORTARIA
        $visitante = Liberar::where([
            ['onesignal_id', '=', $onesignal],
            ['id', '=', $id],
        ])->first();

        $content = array(
            "en" => 'O visitante '.$visitante->apelido.' acabou de SAIR da Vila da Base!'
            );
        
        $fields = array(
            //'app_id' => "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
            'app_id' => "ad2874e6-498f-466d-9080-579bc4df315d",
            'include_external_user_ids' => array($onesignal),
            'channel_for_external_user_ids' => 'push',
            'data' => array("foo" => "bar"),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        //                                           'Authorization: Basic YWIxMDQwNjgtMDFmZS00YmUxLWI1YjMtYzBkYTRjNjg2MTRl'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic YjIxMjkzMzEtMzNkMy00YTRiLWJkYTgtNWVjOWIxOGU1Zjlm'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        //return $response;

        //$response = sendMessage();

        //TÉRMINO DE ENVIO DA NOTIFICAÇÃO QUANDO ENTRA O VISITANTE NA PORTARIA
        return redirect()
                    ->route('liberacao.index')
                    ->with('success', 'Saída do visitante confirmada!');
    }

    public function invalidar_entrada($onesignal, $id){

        // ATUALIZA A TABELA EM DATA E HORA DE ENTRADA E ATUALIZA A COLUNA "movimentacao" PARA "E"
        $dt_entrou = Carbon::now()->format('Y-m-d');
        $hr_entrou = Carbon::now()->format('H:i');

        DB::table('cad_vis_entrada')
            ->where('id', $id)
                ->update([
                    'movimentacao' => 'INVÁLIDA',
                    'dt_entrou' => $dt_entrou,
                    'hr_entrou' => $hr_entrou,
                ]);

        //ENVIO DA NOTIFICAÇÃO QUANDO ENTRA O VISITANTE NA PORTARIA
        $visitante = Liberar::where([
            ['onesignal_id', '=', $onesignal],
            ['id', '=', $id],
        ])->first();
        
        $content = array(
            "en" => 'O visitante '.$visitante->apelido.' não chegou na portaria! Sua liberação foi INVÁLIDA. Favor refazê-la.'
            );
        
        $fields = array(
            //'app_id' => "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
            'app_id' => "ad2874e6-498f-466d-9080-579bc4df315d",
            'include_external_user_ids' => array($onesignal),
            'channel_for_external_user_ids' => 'push',
            'data' => array("foo" => "bar"),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        //                                           'Authorization: Basic YWIxMDQwNjgtMDFmZS00YmUxLWI1YjMtYzBkYTRjNjg2MTRl'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic YjIxMjkzMzEtMzNkMy00YTRiLWJkYTgtNWVjOWIxOGU1Zjlm'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        echo 'a';
        
        //return $response;

        //$response = sendMessage();

        //TÉRMINO DE ENVIO DA NOTIFICAÇÃO QUANDO ENTRA O VISITANTE NA PORTARIA
        return redirect()
                    ->route('liberacao.index')
                    ->with('success', 'Entrada do visitante INVALIDADA!');
    }

}
