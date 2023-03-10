<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;

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
        $usuarios = DB::table('users')->select('id', 'name', 'cpf', 'status', 'autorizacao', 'local')->get();
        return view('usuarios.index', compact('usuarios'));
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

    public function delete($usuario)
    {
        $usuarios = User::find($usuario);
        
        $usuarios->delete();   
        
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Usu??rio exclu??do com sucesso!');

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
                    ->with('success', 'Usu??rio DESABILITADO com sucesso!');

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
                    ->with('success', 'Usu??rio HABILITADO com sucesso!');

    }
}
