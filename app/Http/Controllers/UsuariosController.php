<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Movimentacao;
use App\Local;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$usuarios = User::all();

        $usuarios = DB::table('users')->select('id', 'local', 'name', 'cpf', 'status', 'autorizacao', 'parecer_sint', 'motivo_sint', 'controle_email')->where('status', '<>', '2')->get();
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function index_desabilitados()
    {
        //$usuarios = User::all();

        $usuarios = DB::table('users')->select('id', 'local', 'name', 'cpf', 'status', 'autorizacao', 'parecer_sint', 'motivo_sint', 'controle_email')->where('status', '=', '2')->get();
        return view('usuarios.index_desabilitados', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function select()
    {
        return view('cadastros.select');
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
        $usuario = User::find($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $locais = Local::all();
        return view('usuarios.edit', compact('usuario', 'locais'));
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

        // Encontre o registro no banco de dados
        $usuario = User::find($id);

        // Verifique se o registro existe
        if (!$usuario) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }

        // Obtenha todos os dados da requisição, exceto _method e _token
        $dados = $request->except(['_method', '_token']);

        //atualizar FOTOS
        // Handle File Upload
        if(request()->hasFile('arquivo')){
            // Get filename with the extension
            $filenameWithExt = request()->file('arquivo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = request()->file('arquivo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename.'_'.time().'.'.$extension))));
            // Upload Image
            $path = request()->file('arquivo')->storeAs('/usuarios', $fileNameToStore);
            // Adiciona o nome do arquivo ao array de dados
            $dados['arquivo'] = $fileNameToStore;

        } else {
            $fileNameToStore = 'noimage.png';
        };

        if(request()->hasFile('arquivo_cnh')){
            // Get filename with the extension
            $filenameWithExt_cnh = request()->file('arquivo_cnh')->getClientOriginalName();
            // Get just filename
            $filename_cnh = pathinfo($filenameWithExt_cnh, PATHINFO_FILENAME);
            // Get just ext
            $extension_cnh = request()->file('arquivo_cnh')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_cnh= str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename_cnh.'_'.time().'.'.$extension_cnh))));
            // Upload Image
            $path_cnh = request()->file('arquivo_cnh')->storeAs('/usuarios_cnh', $fileNameToStore_cnh);

            // Adiciona o nome do arquivo ao array de dados
            $dados['arquivo_cnh'] = $fileNameToStore_cnh;
        } else {
            $fileNameToStore_cnh = 'noimage_cnh.png';
        };

        // Filtre os dados para remover campos com valor null
        $dados = array_filter($dados, function ($valor) {
            return !is_null($valor);
        });



        // Atualize o registro com os dados filtrados
        $usuario->update($dados);

        session()->flash('update', 'Usuário ATUALIZADO com sucesso!');

        return redirect()->back()->with('update', 'Usuário ATUALIZADO com sucesso!');
        //return view('usuarios.show', compact('usuario'));
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

    public function delete($usuario)
    {
        $usuarios = User::find($usuario);

        $movimentacao = Movimentacao::where('morador_id', $usuarios->cpf)->get();

        if($movimentacao->isEmpty()){
            $usuarios->delete();
            return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Usuário excluído com sucesso!');    
        } else {
            return redirect()
                    ->route('usuarios.index')
                    ->with('erro', 'Usuário não pode ser excluído! Existem movimentações deste usuário nas portarias.'); 
        }
    }

    public function desativa($usuario)
    {
        $usuarios = User::find($usuario);

            $usuarios->update([
                'status' => "2"
            ]);  
            return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Usuário DESATIVADO com sucesso! Incluído na lista de Inativados.');    
        
    }

    public function reativa($usuario)
    {
        $usuarios = User::find($usuario);

            $usuarios->update([
                'status' => "1"
            ]);  
            return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Usuário REATIVADO com sucesso!');    
        
    }

    public function reset($usuario)
    {
        $usuarios = User::find($usuario);

        $usuarios->update([
            'password' => Hash::make('12345678')
        ]);   
        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Senha do Usuário redefinida com sucesso!');

    }

    public function delete_massa(Request $request)
    {
        //Log::info("DELETE endpoint accessed"); // Adiciona um log para saber se o controlador foi acessado
        
        $ids = $request->input('ids');
        //Log::info('IDs received for deletion:', ['ids' => $ids]); // Para depuração

        if ($ids && is_array($ids)) {
            User::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'No IDs provided'], 400); // Erro se a lista estiver vazia ou não for um array
        }
    }

    public function ativa_massa(Request $request)
    {
        //Log::info("DELETE endpoint accessed"); // Adiciona um log para saber se o controlador foi acessado
        
        $ids = $request->input('ids');
        //Log::info('IDs received for deletion:', ['ids' => $ids]); // Para depuração

        if ($ids && is_array($ids)) {
            User::whereIn('id', $ids)->update(['status' => 1]);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'No IDs provided'], 400); // Erro se a lista estiver vazia ou não for um array
        }
    }

    public function desativa_massa(Request $request)
    {
        //Log::info("DELETE endpoint accessed"); // Adiciona um log para saber se o controlador foi acessado
        
        $ids = $request->input('ids');
        //Log::info('IDs received for deletion:', ['ids' => $ids]); // Para depuração

        if ($ids && is_array($ids)) {
            User::whereIn('id', $ids)->update(['status' => 0]);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'No IDs provided'], 400); // Erro se a lista estiver vazia ou não for um array
        }
    }

    public function parecer_sint($usuario)
    {
        $usuarios = User::find($usuario);
        
        return view('usuarios.parecer_sint', compact('usuarios'));

    }

    public function motivo_sint(Request $request)
    {

        $parecer = DB::table('users')
            ->where('id', $request->id)
            ->update([
                        'motivo_sint' => $request->motivo_sint,
                        'parecer_sint' => $request->parecer_sint
                    ]);

        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Parecer SINT realizado com sucesso!');
    }

    public function desabilitar($usuario)
    {
        $u = User::find($usuario);
        
        DB::table('users')
            ->where('id', $u->id)
            ->update([
                        'status' => '0',
                    ]);        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Usuário DESABILITADO com sucesso!');

    }

    public function habilitar($usuario)
    {
        $u = User::find($usuario);
        
        DB::table('users')
            ->where('id', $u->id)
            ->update([
                        'status' => '1',
                    ]);        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Usuário HABILITADO com sucesso!');

    }

    public function administrador($usuario)
    {
        $u = User::find($usuario);
        
        DB::table('users')
            ->where('id', $u->id)
            ->update([
                        'autorizacao' => 'ad',
                    ]);        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Perfil atualizado para Administrador.');
    }

    public function apemei($usuario)
    {
        $u = User::find($usuario);
        
        DB::table('users')
            ->where('id', $u->id)
            ->update([
                        'funcao' => 'APEMEI',
                    ]);        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Perfil atualizado para Aprovador da EMEI.');
    }

    public function apyjuca($usuario)
    {
        $u = User::find($usuario);
        
        DB::table('users')
            ->where('id', $u->id)
            ->update([
                        'funcao' => 'APYJUCA',
                    ]);        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Perfil atualizado para Aprovador da ESCOLA Y-JUCA PYRAMA.');
    }

    public function apin($usuario)
    {
        $u = User::find($usuario);
        
        DB::table('users')
            ->where('id', $u->id)
            ->update([
                        'funcao' => 'in',
                    ]);        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Perfil atualizado para Aprovador da SINT da BACG.');
    }

    public function resetar($usuario)
    {
        $u = User::find($usuario);
        
        DB::table('users')
            ->where('id', $u->id)
            ->update([
                        'funcao' => null,
                        'autorizacao' => 'mo'
                    ]);        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Perfil atualizado. Todas as funções foram retiradas!');
    }
}
