<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aviso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class AvisosController extends Controller
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
        $avisos = Aviso::all();
        return view('avisos.index', compact('avisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->a_quem == 'TODOS'){
            //ENVIO DA NOTIFICAÇÃO QUANDO ENTRA O VISITANTE NA PORTARIA
                    
            $content = array(
                "en" => 'Novo aviso! '.$request->titulo.'!'
                );
            
            $fields = array(
                //'app_id' => "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
                'app_id' => "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
                'included_segments' => array(
                    'Subscribed Users'
                ),
                //'include_external_user_ids' => array($onesignal),
                //'channel_for_external_user_ids' => 'push',
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
        }
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
            $path = $request->file('arquivo')->storeAs('/avisos', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }
        //save in database
        $avisos = Aviso::create([
            'dono' => $request->dono,
            'titulo' => $request->titulo,
            'mensagem' => $request->mensagem,
            'duracao' => $request->duracao,
            'a_quem' => $request->a_quem,
            'arquivo' => $fileNameToStore,
            'prioridade' => $request->prioridade
        ]);
        
        return redirect()
                    ->route('home')
                    ->with('success', 'Aviso inserido com sucesso!');
    }

    public function download_arquivo($aviso)
    {
        $aviso = Aviso::find($aviso);

        return Storage::download('public/avisos/'.$aviso->arquivo);
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
    public function destroy(Aviso $id)
    {
        echo $id;
        exit;
        $aviso = Aviso::destroy($id);
        return redirect()
                    ->route('avisos.index')
                    ->with('success', 'Aviso excluído com sucesso!');

    }

    public function delete($aviso)
    {
        $avisos = Aviso::find($aviso);
        
        $avisos->delete();   
        
        return redirect()
                    ->route('avisos.index')
                    ->with('success', 'Aviso excluído com sucesso!');

    }
}
