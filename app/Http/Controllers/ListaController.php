<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lista;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;

class ListaController extends Controller
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
        /* antigo
        $listas = Lista::paginate(10);
        return view('listas.create', compact('listas'));
        */

        
        $list = DB::table('cad_vis_entrada')
                    ->where('onesignal_id', Auth::user()->id)
                    ->whereNotNull('lista')
                    ->get();

        $listas = $list->groupBy('lista');

        $listas->toArray() ;
        

        return view('listas.create', compact('listas'));
    }

    public function ver_lista($lista){

        $lista = DB::table('cad_vis_entrada')
                    ->where('lista', $lista)
                    ->get();

        return view('listas.ver_lista', compact('lista'));
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
        $ids_portarias = DB::table('users')->select('id', 'name')->get();

        if ($request->portaria == 'PVO - Vila dos Oficiais (Duque de Caxias)') {
                $p = $ids_portarias->where('name', 'PVO - Portão Vila dos Oficiais');
                $collection = collect([]);
                    foreach($p as $pis){
                        $collection->push((object)['id' => $pis->id]);
                }
                
                $onesignal_portaria = $collection[0]->id;

        }elseif($request->portaria == 'PVSS - Vila dos Suboficiais e Sargentos (Taveirópolis)'){
                $p = $ids_portarias->where('name', 'PVSS - Portão Vila dos Suboficiais e Sargentos');
                $collection = collect([]);
                    foreach($p as $pis){
                        $collection->push((object)['id' => $pis->id]);
                    }

                $onesignal_portaria = $collection[0]->id; 
        }else{

                $onesignal_portaria = NULL; 
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
            $path = $request->file('arquivo')->storeAs('docs/', $fileNameToStore);
        } else {
            $fileNameToStore = 'sem arquivo';
        }
        //save in database
        $listas = Lista::create([
            'dono' => Auth::user()->name,
            'qtn' => $request->qtn,
            'portao' => $request->portaria,
            'onesignal_portaria' => $onesignal_portaria,
            'local_evento' => $request->local_evento,
            'dt_evento' => $request->dt_evento,
            'hr_evento' => $request->hr_evento,
            'arquivo' => $fileNameToStore
        ]);

        //enviar notificação para o portão

        if (!is_null($onesignal_portaria)) {
            $content = array(
                "en" => 'Uma nova lista para Evento foi adicionada para esta Portaria! Baixe agora a lista.'
                );
            
            $fields = array(
                //'app_id' => "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
                'app_id' => "abb1b93c-b19d-4ce0-8fdf-6883aba60666",
                'include_external_user_ids' => array($onesignal_portaria),
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
        }
        
        return redirect()
                    ->route('home')
                    ->with('success', 'Lista de Convidados inserida com sucesso!');
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

    public function lista(){

       $listas = DB::table('lista_ingresso')->orderBy('created_at', 'DESC')->get();
                            
        return view('listas.lista', compact('listas'));

    }

    public function download_lista($lista)
    {
        $listas = Lista::find($lista);

        return Storage::download('docs/'.$listas->arquivo);
        
    }

    public function download_modelo()
    {
        return Storage::download('docs/modelo_lista.xls');
    }
}
