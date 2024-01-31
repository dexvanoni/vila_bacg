<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CadAluno;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CadAlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos_resp = CadAluno::all();
        return view('alunos_resp.index', ['alunos_resp' => $alunos_resp]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //
        //exit;
        // Handle File Upload

            if(request()->hasFile('arquivo_aluno')){
                // Get filename with the extension
                $filenameWithExt = request()->file('arquivo_aluno')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = request()->file('arquivo_aluno')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename.'_'.time().'.'.$extension))));
                // Upload Image
                $path = request()->file('arquivo_aluno')->storeAs('/alunos', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.png';
            }

          if(request()->hasFile('arquivo_resp')){
            // Get filename with the extension
            $filenameWithExt_resp = request()->file('arquivo_resp')->getClientOriginalName();
            // Get just filename
            $filename_resp = pathinfo($filenameWithExt_resp, PATHINFO_FILENAME);
            // Get just ext
            $extension_resp = request()->file('arquivo_resp')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_resp = str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename_resp.'_'.time().'.'.$extension_resp))));
            // Upload Image
            $path_resp = request()->file('arquivo_resp')->storeAs('/alunos', $fileNameToStore_resp);
          } else {
            $fileNameToStore_resp = 'noimage.png';
          }  
        
        

      if ($request->autorizacao_aluno == 'al') {

            $request['nome_resp'] = '--';
            $request['cpf_resp'] = '0';
            $request['rg_resp'] = '0';
            $request['num_cnh_resp'] = '--';
            $request['tipo_cnh_resp'] = '--';
            $request['validade_cnh_resp'] = '--';
            $request['rua_resp'] = '--';
            $request['num_casa_resp'] = '--';
            $request['bairro_resp'] = '--';
            $request['cidade_resp'] = '--';
            $request['cep_resp'] = '0';
            $request['arquivo_resp'] = '--';
            $request['tel_resp'] = '--';
            $request['email_resp'] = $request['cpf_aluno'].'@aluno.COM';
      }

            CadAluno::create([

            'nome_aluno' => $request['nome_aluno'],
            'local_aluno' => $request['local_aluno'],
            'dt_nascimento_aluno' => $request['dt_nascimento_aluno'],
            'serie_aluno' => $request['serie_aluno'],
            'cpf_aluno' => $request['cpf_aluno'],
            'rg_aluno' => $request['rg_aluno'],
            'rua_aluno' => $request['rua_aluno'],
            'num_casa_aluno' => $request['num_casa_aluno'],
            'bairro_aluno' => $request['bairro_aluno'],
            'cidade_aluno' => $request['cidade_aluno'],
            'cep_aluno' => $request['cep_aluno'],
            'nome_resp' => $request['nome_resp'],
            'nome_aluno_resp' => $request['nome_aluno_resp'],
            'cpf_aluno_resp' => $request['cpf_aluno_resp'],
            'cpf_resp' => $request['cpf_resp'],
            'rg_resp' => $request['rg_resp'],
            'num_cnh_resp' => $request['num_cnh_resp'],
            'tipo_cnh_resp' => $request['tipo_cnh_resp'],
            'validade_cnh_resp' => $request['validade_cnh_resp'],
            'rua_resp' => $request['rua_resp'],
            'num_casa_resp' => $request['num_casa_resp'],
            'bairro_resp' => $request['bairro_resp'],
            'cidade_resp' => $request['cidade_resp'],
            'cep_resp' => $request['cep_resp'],
            'arquivo_resp' => $fileNameToStore_resp,
            'tel_resp' => $request['tel_resp'],
            'email_resp' => $request['email_resp'],
            'status_aluno' => $request['status_aluno'],
            'tipo_aluno' => $request['tipo_aluno'],
            'arquivo_aluno' => $fileNameToStore
            
        ]);

            return redirect()
                    ->route('login')
                    ->with('success', 'Você fez sua pré-inscrição. Aguarde o contato de confirmação de cadastro!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alunos_resp = CadAluno::find($id);
        //dd($alunos_resp);
        //exit;
        return view('alunos_resp.show', compact('alunos_resp'));
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

    public function pesquisar(Request $request)
    {
        
        try {
            $termoPesquisa = $request->input('termo_pesquisa');

            // Realize a pesquisa no banco de dados
            $resultados = DB::table('alunos')->where('cpf_aluno', $termoPesquisa)->get();
            return response()->json($resultados);
            
        } catch (\Exception $e) {
            // Logue a exceção
            \Log::error('Erro na pesquisa: ' . $e->getMessage());
            
            // Retorne uma resposta de erro genérica
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }


    public function delete($aluno_resp)
    {
        $aluno_resp = CadAluno::find($aluno_resp);
        
        $aluno_resp->delete();   
        
        return redirect()
                    ->route('aluno_resp.index')
                    ->with('success', 'Usuário excluído com sucesso!');

    }

    public function desabilitar($aluno_resp)
    {
        $u = CadAluno::find($aluno_resp);
        
        DB::table('alunos')
            ->where('id', $u->id)
            ->update([
                        'status' => '0',
                    ]);        
        return redirect()
                    ->route('aluno_resp.index')
                    ->with('success', 'Usuário DESABILITADO com sucesso!');

    }

    public function habilitar($aluno_resp)
    {
        $u = CadAluno::find($aluno_resp);
       DB::table('alunos')
            ->where('id', $u->id)
            ->update([
                        'status' => '1',
                    ]);        
        return redirect()
                    ->route('aluno_resp.index')
                    ->with('success', 'Usuário HABILITADO com sucesso!');

    }
}
