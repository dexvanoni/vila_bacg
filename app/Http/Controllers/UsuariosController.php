<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Log;

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

        $usuarios = DB::table('users')->select('id', 'name', 'cpf', 'status', 'autorizacao', 'parecer_sint')->get();
        return view('usuarios.index', ['usuarios' => $usuarios]);
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
        return view('usuarios.edit', compact('usuario'));
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
        $usuario = User::find($id);
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'autorizacao' => $request->autorizacao,
            'local' => $request->local,
            'telefone' => $request->telefone,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'status' => $request->status,
        ]);
        return view('usuarios.show', compact('usuario'));
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

        $usuarios->delete();   
        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Usuário excluído com sucesso!');

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
}
