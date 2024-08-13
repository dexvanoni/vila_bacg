<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ocorrencia;
use Auth;

class OcorrenciasController extends Controller
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
    public function index()
    {
        if (Auth::user()->autorizacao == 'ad') {
            $ocorrencias = Ocorrencia::all();
        } else {
            $ocorrencias = Ocorrencia::where('dono', Auth::user()->name)->get();
        }
            return view('ocorrencias.index', compact('ocorrencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        return view('ocorrencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Handle File Upload
        if($request->hasFile('arquivo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('arquivo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('arquivo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename.'_'.time().'.'.$extension))));
            // Upload Image
            $path = $request->file('arquivo')->storeAs('/ocorrencias', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }
        //save in database
        $ocorrencias = Ocorrencia::create([
            'dono' => Auth::user()->name,
            'mensagem' => $request->mensagem,
            'duracao' => $request->duracao,
            'a_quem' => Auth::user()->local,
            'prioridade' => $request->prioridade,
            'arquivo' => $fileNameToStore,
            'status' => 'Novo'
        ]);
        
        return redirect()
                    ->route('ocorrencias.index')
                    ->with('success', 'Ocorrência inserida com sucesso!');
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

    public function delete($ocorrencia)
    {
        $ocorrencias = Ocorrencia::find($ocorrencia);
        
        $ocorrencias->delete();   
        
        return redirect()
                    ->route('ocorrencias.index')
                    ->with('success', 'Ocorrência excluída com sucesso!');

    }
}
